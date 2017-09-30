<?php

namespace App\Http\Middleware;

use Closure;

class isUnderMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $maintenance_mode = config('custom_settings.is_under_maintenance');
        if ($request->path() != 'maintenance') {
            if($maintenance_mode)
            {
                return redirect()->route('maintenance');
            }
        }
        else
        {
            if (!$maintenance_mode) {
                return redirect()->back();
            }
        }
        
        return $next($request);
    }
}
