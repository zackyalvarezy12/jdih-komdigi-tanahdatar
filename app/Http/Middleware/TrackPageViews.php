<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\PageView;

class TrackPageViews
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Pastikan request adalah GET, bukan AJAX, dan tabelnya ada
        if ($request->isMethod('GET') && !$request->ajax() && Schema::hasTable('page_views')) {
            
            $ip = $request->ip();
            $path = $request->path();

            // CEK: Apakah IP yang sama sudah mengunjungi path ini dalam 1 jam terakhir?
            $alreadyTracked = PageView::where('ip_address', $ip)
                ->where('path', $path)
                ->where('created_at', '>', now()->subHours(1)) 
                ->exists();

            if (!$alreadyTracked) {
                PageView::create([
                    'ip_address' => $ip,
                    'path' => $path,
                    'user_agent' => substr($request->userAgent() ?? '', 0, 500),
                ]);
            }
        }

        return $next($request);
    }
}
