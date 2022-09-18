<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Admin_u
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->fk_i_role_id != 96) {
            return redirect("/newest")->with("e_msg", "لا تملك الصلاحية للدخول إلى هنا");
        }
        return $next($request);
    }
}
