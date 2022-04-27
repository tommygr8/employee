<?php

namespace App\Providers;

use App\Interfaces\UserInterface;
use App\Services\UserService;

use Illuminate\Http\Response;
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
        $this->app->bind(UserInterface::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function($message, $data) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $data

            ]);
        });

        Response::macro( 'error', function($message, $error, $status_code) {
            return response()->json([
                "status" => "false",
                "message" => $message,
                "error" => $error
            ], $status_code);
        });
    }
}
