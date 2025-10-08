<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PageView;
use Jenssegers\Agent\Agent;

class TrackPageView
{
    public function handle(Request $request, Closure $next)
    {
        // Skip tracking untuk:
        // - Admin routes
        // - API routes
        // - Asset files
        // - AJAX requests
        if (
            $request->is('admin*') || 
            $request->is('api*') || 
            $request->is('storage/*') ||
            $request->ajax()
        ) {
            return $next($request);
        }

        try {
            // Detect device
            $agent = new Agent();
            $deviceType = $agent->isMobile() ? 'mobile' : ($agent->isTablet() ? 'tablet' : 'desktop');

            // Get page name
            $pageName = $this->getPageName($request->path());

            // Track page view
            PageView::create([
                'page_url' => $request->fullUrl(),
                'page_name' => $pageName,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'device_type' => $deviceType,
                'referer' => $request->header('referer'),
                'visited_at' => now(),
            ]);
        } catch (\Exception $e) {
            // Log error tapi jangan stop request
            \Log::error('Failed to track page view: ' . $e->getMessage());
        }

        return $next($request);
    }

    private function getPageName($path)
    {
        $routes = [
            '/' => 'Home',
            'tentang-kami' => 'Tentang Kami',
            'layanan' => 'Layanan',
            'program' => 'Program',
            'kontak' => 'Kontak',
        ];

        return $routes[$path] ?? 'Other';
    }
}