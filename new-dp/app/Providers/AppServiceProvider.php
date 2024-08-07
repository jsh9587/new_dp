<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application Services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application Services.
     */
    public function boot(): void
    {
        //
        DB::listen(function ($query) {
            Log::channel('query_log')->info('SQL Query: ' . $query->sql, $query->bindings);
        });
    }
}
