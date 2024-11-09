<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }
    protected function mapApiRoutes()
    {
        Route::prefix('api') // Prefix API routes with /api
            ->middleware('api') // Apply the API middleware
            ->group(base_path('routes/api.php')); // Define routes in api.php
    }
    protected function mapWebRoutes()
    {
        Route::middleware('web') // Apply the web middleware
            ->group(base_path('routes/web.php')); // Define routes in web.php
    }
    public function register()
    {
        //
    }
}


















