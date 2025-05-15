<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Detection\MobileDetect;
class MobileDetection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $detect = new MobileDetect();
        // Check if the device is mobile
        if ($detect->isMobile() && !$detect->isTablet()) {
            return $next($request); // Allow access to the next request (homepage)
        }

        // If not a mobile device, return a warning view
        return response()->view('alert.warning-device');
    }
}
