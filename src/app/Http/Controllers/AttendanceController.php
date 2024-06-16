<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function attendance()
    {
        $user = Auth::user();
        return view("stamping",compact("user"));
    }

    // 出勤開始処理
    public function startAttendance(Request $request)
    {
        $request->session()->regenerateToken();
        // 直接Auth::user()で情報を取得できるが、そうするとエディタでエラーになるので、二度手間だが、UserのidからUser情報を取得している。
        $user = User::find(Auth::user()->id);
        $user->startAttendance($user->id);
        return redirect(route("attendance"));
    }

    // 出勤終了処理
    public function endAttendance(Request $request)
    {
        $request->session()->regenerateToken();
        // 直接Auth::user()で情報を取得できるが、そうするとエディタでエラーになるので、二度手間だが、UserのidからUser情報を取得している。
        $user = User::find(Auth::user()->id);
        $user->endAttendance($user->id);
        return redirect(route("attendance"));
    }

    // 休憩開始処理
    public function startBreakTime(Request $request)
    {
        $request->session()->regenerateToken();
        // 直接Auth::user()で情報を取得できるが、そうするとエディタでエラーになるので、二度手間だが、UserのidからUser情報を取得している。
        $user = User::find(Auth::user()->id);
        $user->startBreakTime($user->id);
        return redirect(route("attendance"));
    }

    // 休憩終了処理
    public function endBreakTime(Request $request)
    {
        $request->session()->regenerateToken();
        // 直接Auth::user()で情報を取得できるが、そうするとエディタでエラーになるので、二度手間だが、UserのidからUser情報を取得している。
        $user = User::find(Auth::user()->id);
        $user->endBreakTime($user->id);
        return redirect(route("attendance"));
    }
}
