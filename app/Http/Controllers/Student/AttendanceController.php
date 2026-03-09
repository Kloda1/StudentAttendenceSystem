<?php


namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LectureSession;
use App\Models\Attendance;
use App\Models\AttendanceToken;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('student.attendance');
    }


    public function showQr(LectureSession $session)
    {
        if ($session->status !== 'active') {
            abort(403);
        }


        AttendanceToken::where('lecture_session_id', $session->id)
            ->where('expires_at', '<', now())
            ->delete();


//        $tokenValue = bin2hex(random_bytes(16));
        $tokenValue = Str::random(32);

        AttendanceToken::create([
            'lecture_session_id' => $session->id,
            'token_type' => 'qr',
            'token_value' => $tokenValue,
            'expires_at' => now()->addSeconds($session->qr_refresh_rate),
        ]);

        $tokenData = route('student.attendance.verify.token', ['token' => $tokenValue]);


//        $tokenData = config('app.url') . '/student/attendance/verify/' . $tokenValue;
//        $tokenData = route('student.attendance.verify.form', ['session' => $session->id]);
        $writer = new PngWriter();
        $qrCode = new \Endroid\QrCode\QrCode($tokenData);
        $result = $writer->write($qrCode);
        $qr = $result->getDataUri();

//        $otp = $session->session_otp;
        $otp = rand(100000, 999999);
        $session->update(['session_otp' => $otp]);
        return view('teacher.lecture-session-qr', [
            'session' => $session,
            'qr' => $qr,
            'otp' => $otp,
            'tokenValue' => $tokenValue
        ]);


    }


    public function scan(Request $request, LectureSession $session)
    {
        if ($session->status !== 'active') {
            abort(403, __('session.not_active'));
        }

        return redirect()->route('student.attendance.verify.form', [
            'session' => $session->id
        ]);
    }


    public function verifyToken($tokenValue)
    {
        $token = AttendanceToken::where('token_value', $tokenValue)
            ->where('expires_at', '>=', now())
            ->where('is_used', false)
            ->first();

        if (!$token) {
            abort(403, __('session.token_expired'));
        }

        $session = $token->lectureSession;
        session(['verify_session' => $session->id]);

        return view('student.attendance', [
            'sessionId' => $session->id
        ]);
    }

    public function verifySession($sessionId)
    {
        $session = LectureSession::findOrFail($sessionId);


        if (now()->diffInSeconds($session->created_at) > $session->qr_refresh_rate) {
            abort(403, __('session.token_expired'));
        }

        session(['verify_session' => $sessionId]);

        return view('student.attendance', [
            'sessionId' => $sessionId
        ]);
    }

    public function store(Request $request, $sessionId)
    {
        $request->validate([
            'student_number' => 'required',
            'otp' => 'required',
        ]);

        $student = Student::where('student_number', $request->student_number)->first();
        if (!$student) return back()->with('error', __('student.not_found'));

        $session = LectureSession::with('subject')->find($sessionId);
        if (!$session) return back()->with('error', __('session.not_found'));


        if (now()->diffInSeconds($session->created_at) > $session->qr_refresh_rate) {
            return back()->with('error', __('session.token_expired'));
        }

        if ($session->session_otp != $request->otp) {
            return back()->with('error', __('student.invalid_otp'));
        }

        if ($session->subject) {
            $isEnrolled = $student->subjects()->where('subject_id', $session->subject_id)->exists();
            if (!$isEnrolled) return back()->with('error', __('student.not_enrolled_in_subject'));
        }

        Attendance::create([
            'student_id' => $student->id,
            'lecture_session_id' => $sessionId,
            'attendance_time' => now()
        ]);

        return back()->with('success', __('student.attendance_recorded'));
    }


}
