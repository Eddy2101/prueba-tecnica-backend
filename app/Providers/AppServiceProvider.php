<?php

namespace App\Providers;

use App\Http\Respositories\Interfaces\UsuarioRepositoryInterface;
use App\Http\Respositories\UsuarioRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
