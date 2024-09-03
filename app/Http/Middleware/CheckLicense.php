<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLicense
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user->hasValidLicense()) {
            return redirect()->route('licenses.index')->with('error', 'Votre licence a expiré.');
        }

        return $next($request);
    }
}
