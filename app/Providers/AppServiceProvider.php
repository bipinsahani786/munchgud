<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        // Load app.css asynchronously to prevent render blocking and optimize Lighthouse scores
        \Illuminate\Support\Facades\Vite::useStyleTagAttributes(function (string $src, string $url, ?array $chunk, ?array $manifest) {
            if ($src === 'resources/css/app.css') {
                return [
                    'media' => 'print',
                    'onload' => "this.media='all'",
                ];
            }
            return [];
        });
        // Override mail config from database settings (runs in web and queue/console environments safely)
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $mailHost = \App\Models\Setting::get('mail_host');
                if ($mailHost) {
                    config([
                        'mail.mailers.smtp.host' => $mailHost,
                        'mail.mailers.smtp.port' => \App\Models\Setting::get('mail_port', env('MAIL_PORT', 2525)),
                        'mail.mailers.smtp.username' => \App\Models\Setting::get('mail_username', env('MAIL_USERNAME')),
                        'mail.mailers.smtp.password' => \App\Models\Setting::get('mail_password', env('MAIL_PASSWORD')),
                        'mail.from.address' => \App\Models\Setting::get('mail_from_address', env('MAIL_FROM_ADDRESS', 'hello@example.com')),
                        'mail.from.name' => \App\Models\Setting::get('mail_from_name', env('MAIL_FROM_NAME', 'Example')),
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Database not fully migrated or ready yet, ignore and use .env defaults
        }

        // Share categories and cart count with storefront views
        if (!app()->runningInConsole()) {
            \Illuminate\Support\Facades\View::composer('*', function ($view) {
                $view->with('global_settings', \App\Models\Setting::pluck('value', 'key')->toArray());

                // Only inject $page for storefront routes to prevent overriding admin controllers
                if (!request()->is('admin/*') && !request()->is('login') && !request()->is('register')) {
                    $path = request()->path();
                    if ($path == '/')
                        $path = 'home';
                    $page = \App\Models\Page::where('slug', $path)->first();
                    if (!$page) {
                        $routeName = request()->route() ? request()->route()->getName() : null;
                        if ($routeName) {
                            $page = \App\Models\Page::where('slug', $routeName)->first();
                        }
                    }
                    if ($page) {
                        $view->with('page', $page);
                    }
                }

                if (\Illuminate\Support\Facades\Schema::hasTable('categories')) {
                    $view->with('global_categories', \App\Models\Category::active()->whereNull('parent_id')->orderBy('sort_order', 'asc')->get());
                } else {
                    $view->with('global_categories', collect());
                }


                try {
                    $cartService = app(\App\Services\CartService::class);
                    $view->with('cart_count', $cartService->getSummary()['items_count'] ?? 0);
                } catch (\Exception $e) {
                    $view->with('cart_count', 0);
                }
            });
        }
    }
}
