<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use App\Models\Visit;

class RecordVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */

    const THRESHOLD = 900; // 15 minutes
    
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        if ($this->shouldRecord($request)) {
            $this->record($request);
        }
        
        return $response;
    }
    
    private function shouldRecord(Request $request): bool
    {
        if($request->is('api/*') && $request->expectsJson()) {
            return false;
        }
        
        return true;
    }
    
    private function record(Request $request): void
    {
        $key = 'visit:' . $request->ip() . ':' . $request->path();

        // Check if already visited within threshold
        if (!Cache::has($key)) {
           Visit::create([
               'ip_address' => $request->ip(),
               'user_agent' => $request->header('user-agent'),
               'referer' => $request->headers->get('referer'),
               'path' => $request->path(),
               'query' => $request->getQueryString(),
               'visited_at' => now(),
           ]);
        }
        
        Cache::put($key, true, self::THRESHOLD);
    }
}
