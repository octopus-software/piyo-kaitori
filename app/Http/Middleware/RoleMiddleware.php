<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param int $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, int $role)
    {
        // ユーザーが認証されていない場合はリダイレクト
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // ユーザーのロールをチェック
        if (auth()->user()['role'] != $role) {
            abort(403, 'このページにアクセスする権限がありません。');
        }

        return $next($request);
    }
}
