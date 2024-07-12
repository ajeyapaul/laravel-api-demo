<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Gate;

class ApprovalMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            if (! auth()->user()->approved) {
                auth()->logout();

                return redirect()->route('login')->with('message', __('Your accounts needs an administrator approval in order to log in'));
            }
        }

        return $next($request);
    }
}
