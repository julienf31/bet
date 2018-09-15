<?php

namespace App\Http\Middleware;

use App\Log;
use Closure;
use Illuminate\Support\Facades\Auth;

class LogRequests
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
        if(Auth::user()){
            $user = Auth::user()->id;
        } else {
            $user = null;
        }
        $log = [
            'user_id' => $user,
            'path'    => substr($request->path(), 0, 255),
            'method'  => $request->method(),
            'ip'      => $request->getClientIp(),
            'input'   => json_encode($request->input()),
        ];

        Log::create($log);
        return $next($request);
    }
}
