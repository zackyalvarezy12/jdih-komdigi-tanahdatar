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

        if ($request->isMethod('GET') && !$request->ajax() && Schema::hasTable('page_views')) {
            PageView::create([
                'ip_address' => $request->ip(),
                'path' => $request->path(),
                'user_agent' => substr($request->userAgent() ?? '', 0, 500),
            ]);
        }

        return $response;
    }
}
