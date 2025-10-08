<?php

namespace App\Helpers;

use App\Models\PageClick;

class AnalyticsHelper
{
    public static function trackClick($type, $label = null, $pageUrl = null)
    {
        try {
            PageClick::create([
                'click_type' => $type,
                'click_label' => $label,
                'page_url' => $pageUrl ?? url()->current(),
                'ip_address' => request()->ip(),
                'clicked_at' => now(),
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to track click: ' . $e->getMessage());
        }
    }
}