<?php

namespace App\Providers;

use App\Models\Category;
use App\Support\Iyzico\LocalHttpClient;
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
        if ($this->app->environment('local')) {
            ApiResource::setHttpClient(new LocalHttpClient());
        }

        View::composer('frontend.*', function ($view) {
            $view->with('categories', Category::where('is_active', 1)
                ->orderBy('name')
                ->get());
        });
    }
}
