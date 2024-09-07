<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    //  سیستم احراز هویت خاص مانند web,api guard برای تعیین گزینه‌ای
    public function handle($request, Closure $next, $guard = null)
    {
        // اگر کاربر احراز هویت نشده است، به صفحه لاگین هدایت می‌شود
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('login');
        }

        // اگر کاربر احراز هویت شده است، درخواست به ادامه مسیر هدایت می‌شود
        return $next($request);
    }
}
