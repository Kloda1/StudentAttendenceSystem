<?php


namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LectureSession;
use App\Models\Attendance;
use App\Models\AttendanceToken;
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



    public function verifyOtp(Request $request)
    {
        $sessionId = session('verify_session');

        $user = User::where('student_number', $request->student_number)->first();

        if (!$user) {
            return back()->withErrors(['student_number' => __('student.not_found')]);
        }

        $session = LectureSession::find($sessionId);

        if (!$session || $session->session_otp != $request->otp) {
            return back()->withErrors(['otp' => __('student.invalid_otp')]);
        }

        Attendance::create([
            'student_id' => $user->id,
            'lecture_session_id' => $session->id,
            'attendance_time' => now()
        ]);

        return redirect('/student')->with('success', __('student.attendance_recorded'));
    }


    public function showQr(LectureSession $session)
    {
        $user = auth()->user();

        if (!$user) {
            abort(403);
        }

        if ($session->status !== 'active') {
            abort(403);
        }

        if (
            !$user->hasRole('super_admin') &&
            $user->id !== $session->lecturer_id
        ) {
            abort(403);
        }

        $otp = $session->session_otp;

        session([
            'session_id' => $session->id
        ]);

        $tokenData = route('student.attendance.verify.form', [
            'session' => $session->id
        ]);
        $writer = new PngWriter();
        $qrCode = new \Endroid\QrCode\QrCode($tokenData);

        $result = $writer->write($qrCode);
        $qr = $result->getDataUri();

        return view('teacher.lecture-session-qr', [
            'session' => $session,
            'qr' => $qr,
            'otp' => $otp
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





    public function store(Request $request, $sessionId)
    {
        $request->validate([
            'student_number' => 'required',
            'otp' => 'required'
        ]);

        $student = User::where('student_number', $request->student_number)->first();

        if (!$student) {
            return back()->with('error', __('student.not_found'));
        }

        $session = LectureSession::find($sessionId);

        if (!$session) {
            return back()->with('error', __('session.not_found'));
        }

        if ($session->session_otp != $request->otp) {
            return back()->with('error', __('student.invalid_otp'));
        }

        Attendance::create([
            'student_id' => $student->id,
            'lecture_session_id' => $sessionId,
            'attendance_time' => now()
        ]);

        return back()->with('success', __('student.attendance_recorded'));
    }
}
