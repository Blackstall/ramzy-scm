<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckFranchiseeStatus
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $agreement = $user->franchiseeAgreement;

        if (!$agreement || $agreement->status !== 'Completed') {
            return redirect()->route('packages.index')->with('error', 'You must complete the franchise agreement process.');
        }

        return $next($request);
    }
}
