<?php

if (!function_exists('settings')) {
    function settings(string $key, $default = null) {
        return \App\Models\Setting::get($key, $default);
    }
}
