<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\SiteSetting;
use App\Support\Iyzico\LocalHttpClient;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Pagination\Paginator;
use Iyzipay\ApiResource;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFour();

        if ($this->app->environment('local')) {
            ApiResource::setHttpClient(new LocalHttpClient());
        }

        $this->ensureStorageLinkExists();

        View::composer('frontend.*', function ($view) {
            $view->with('categories', Category::where('is_active', 1)
                ->orderBy('name')
                ->get());

            $view->with('siteSettings', SiteSetting::query()->firstOrCreate(['id' => 1], SiteSetting::defaults()));
        });
    }

    private function ensureStorageLinkExists(): void
    {
        $linkPath = public_path('storage');

        if (is_link($linkPath) || file_exists($linkPath)) {
            return;
        }

        try {
            Artisan::call('storage:link', ['--quiet' => true]);
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
