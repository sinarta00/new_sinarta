<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Setting;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        $isMaintenanceMode = Setting::get('maintenance_mode', '0');
        
        // Cek apakah maintenance mode aktif
        if ($isMaintenanceMode === '1' || $isMaintenanceMode === 'true') {
            
            // Bypass untuk Filament admin panel
            if ($request->is('admin*')) {
                return $next($request);
            }
            
            // Admin bypass dengan token di URL
            $adminToken = Setting::get('admin_bypass_token');
            
            if ($request->query('admin_token') === $adminToken && $adminToken) {
                session(['admin_bypass' => true]);
                return $next($request);
            }
            
            // Cek session bypass
            if (session('admin_bypass')) {
                return $next($request);
            }
            
            // Tampilkan halaman maintenance
            return response()->view('maintenance', [], 503);
        }
        
        return $next($request);
    }
}