<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNotificationReadAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->query("notify")){
            $notificarion = auth()->user()->notifications()->where('id', $request->query("notify"))->first();
            if($notificarion){
                $notificarion->markAsRead();
            }
        }
        return $next($request);
    }
}
