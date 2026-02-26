<?php

namespace App\Http\Controllers\Student;


use App\Http\Controllers\Controller;
use App\Models\LectureSession;
use App\Models\Attendance;
use App\Models\AttendanceToken;
use App\Models\StudentDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
   public function index()
    {
         return view('student.attendance');
    }

    public function scan(Request $request)
    {
        $request->validate([
            'qr_data' => 'required|string',
        ]);

        $user = Auth::user();

         $data = json_decode($request->qr_data, true);
        if (!$data || !isset($data['session_id'], $data['token'], $data['expires_at'])) {
            return response()->json(['error' => 'QR code غير صالح'], 422);
        }


        $session = LectureSession::find($data['session_id']);
        if (!$session) {
            return response()->json(['error' => 'error'], 404);
        }

        if (now()->gt($data['expires_at'])) {
            return response()->json(['error' => 'expired'], 422);
        }

         $token = AttendanceToken::where('lecture_session_id', $session->id)
            ->where('token_value', $data['token'])
            ->where('is_used', false)
            ->first();
        if (!$token) {
            return response()->json(['error' => 'error'], 422);
        }


        $clientIp = $request->ip();
        $hall = $session->hall;
        if ($hall && $hall->ip_range_start && $hall->ip_range_end) {

            $ipLong = ip2long($clientIp);
            $startLong = ip2long($hall->ip_range_start);
            $endLong = ip2long($hall->ip_range_end);
            if ($ipLong < $startLong || $ipLong > $endLong) {

                \App\Models\FailedAttempt::create([
                    'student_id' => $user->id,
                    'lecture_session_id' => $session->id,
                    'reason' => 'wrong_ip',
                    'ip_address' => $clientIp,
                    'description' => 'IP خارج النطاق b',
                ]);
                return response()->json(['error' => 'network error '], 403);
            }
        }


        $fingerprint = $request->input('fingerprint');
        if ($fingerprint) {
             $existing = Attendance::where('lecture_session_id', $session->id)
                ->where('device_fingerprint', $fingerprint)
                ->where('student_id', '!=', $user->id)
                ->exists();
            if ($existing) {

                \App\Models\FailedAttempt::create([
                    'student_id' => $user->id,
                    'lecture_session_id' => $session->id,
                    'reason' => 'duplicate_device',
                    'ip_address' => $clientIp,
                    'description' => 'used',
                ]);
                return response()->json(['error' => 'used'], 403);
            }


            StudentDevice::firstOrCreate(
                ['device_fingerprint' => $fingerprint],
                [
                    'student_id' => $user->id,
                    'device_type' => $request->input('device_type', 'mobile'),
                    'device_name' => $request->input('device_name'),
                    'device_model' => $request->input('device_model'),
                    'operating_system' => $request->input('os'),
                    'browser' => $request->input('browser'),
                    'last_ip_address' => $clientIp,
                    'last_login_at' => now(),
                    'is_trusted' => true,
                ]
            );
        }


        $alreadyAttended = Attendance::where('lecture_session_id', $session->id)
            ->where('student_id', $user->id)
            ->exists();
        if ($alreadyAttended) {
            return response()->json(['error' => 'مكرر'], 422);
        }


        $attendance = Attendance::create([
            'lecture_session_id' => $session->id,
            'student_id' => $user->id,
            'attendance_token_id' => $token->id,
            'attendance_time' => now(),
            'attendance_method' => 'qr_scan',
            'attendance_status' => 'present',
            'ip_address' => $clientIp,
            'device_fingerprint' => $fingerprint,
        ]);


        $token->update(['is_used' => true, 'used_by' => $user->id, 'used_at' => now()]);

        $session->increment('actual_attendance');

        return response()->json(['success' => true, 'message' => 'تم']);
    }
}
