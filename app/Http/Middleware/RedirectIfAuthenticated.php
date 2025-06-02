<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                /** @var User $user */
                $user = Auth::guard($guard)->user();
                
                if (!$user) {
                    return redirect('/login');
                }

                try {
                    switch($user->role) {
                        case 'superadmin':
                            return redirect()->route('superadmin.dashboard');
                        case 'waka_kurikulum':
                            return redirect()->route('wakakurikulum.dashboard');
                        case 'guru_mapel':
                            return redirect()->route('gurumapel.dashboard');
                        case 'walikelas':
                            return redirect()->route('walikelas.dashboard');
                        default:
                            return redirect('/home');
                    }
                } catch (\Exception $e) {
                    Auth::logout();
                    return redirect('/login')->with('error', 'Terjadi kesalahan pada role pengguna');
                }
            }
        }

        return $next($request);
    }
}