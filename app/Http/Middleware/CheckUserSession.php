<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CheckUserSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('sessionUserId')) {
            return redirect('/')->with('login', 'Vui lòng đăng nhập để thực hiện thao tác này.');
        } else {
            $userId = session('sessionUserId');
            $user = DB::table('nguoidungs')->where('IsActive', true)->where('id', $userId)->first();
            if (!$user) {
                return redirect('/')->with('login', 'Vui lòng đăng nhập để thực hiện thao tác này.');
            }
            return $next($request);
        }
    }
}
