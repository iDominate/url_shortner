<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('with', function (string|array $data, string $status, int $code) {
            $dataArray = [
                'status' => $status,
                'code' => $code,
                'data' => $data
            ];
            return response()->json(data: $dataArray, status: $code);
        });
    }
}