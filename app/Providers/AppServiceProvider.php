<?php

namespace App\Providers;

use Livewire\Livewire; 
use App\Livewire\OrderForm;
use App\View\Components\Footer;
use App\View\Components\Navbar;
use App\View\Components\AppLayout;
use App\Repositories\OrderRepository;
use App\Repositories\ShirtRepository;
use Illuminate\Support\Facades\Blade;
use App\Repositories\ReportRepository;
use App\Repositories\SearchRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\PromoCodeRepository;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ShirtRepositoryInterface;
use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Repositories\Contracts\SearchRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\PromoCodeRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->singleton(ShirtRepositoryInterface::class, ShirtRepository::class);
        $this->app->singleton(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->singleton(PromoCodeRepositoryInterface::class, PromoCodeRepository::class);
        $this->app->bind(SearchRepositoryInterface::class, SearchRepository::class);
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);
    }

    public function boot(): void
    {
        Blade::component('app-layout', AppLayout::class);
        
        Livewire::component('order-form', OrderForm::class);
    }
}