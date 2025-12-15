<?php

namespace App\Providers;

use App\Http\Repositories\CommonRepository;
use App\Http\Repositories\Interfaces\CommonRepositoryInterface;
use App\Http\Repositories\Interfaces\TaskRepositoryInterface;
use App\Http\Repositories\Interfaces\UsuarioRepositoryInterface;
use App\Http\Repositories\UsuarioRepository;
use App\Http\Repositories\TaskRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(UsuarioRepositoryInterface::class,UsuarioRepository::class);

        $this->app->bind(
            TaskRepositoryInterface::class,
            TaskRepository::class
        );

        $this->app->bind(
            CommonRepositoryInterface::class,
            CommonRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
