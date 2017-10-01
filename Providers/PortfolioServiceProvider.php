<?php

namespace Modules\Portfolio\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Portfolio\Composers\Backend\BrandComposer;
use Modules\Portfolio\Composers\Backend\CategoryComposer;
use Modules\Portfolio\Events\Handlers\RegisterPortfolioSidebar;
use Modules\Portfolio\Widgets\BrandsWidget;

class PortfolioServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration, CanGetSidebarClassForModule;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();

        $this->app['events']->listen(
            BuildingSidebar::class,
            $this->getSidebarClassForModule('Portfolio', RegisterPortfolioSidebar::class)
        );

        view()->composer('portfolio::admin.portfolios.*', CategoryComposer::class);
        view()->composer('portfolio::admin.portfolios.*', BrandComposer::class);

        \Widget::register('portfolio_brands', BrandsWidget::class);
    }

    public function boot()
    {
        $this->publishConfig('portfolio', 'permissions');
        $this->publishConfig('portfolio', 'config');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Portfolio\Repositories\PortfolioRepository',
            function () {
                $repository = new \Modules\Portfolio\Repositories\Eloquent\EloquentPortfolioRepository(new \Modules\Portfolio\Entities\Portfolio());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Portfolio\Repositories\Cache\CachePortfolioDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Portfolio\Repositories\CategoryRepository',
            function () {
                $repository = new \Modules\Portfolio\Repositories\Eloquent\EloquentCategoryRepository(new \Modules\Portfolio\Entities\Category());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Portfolio\Repositories\Cache\CacheCategoryDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Portfolio\Repositories\BrandRepository',
            function () {
                $repository = new \Modules\Portfolio\Repositories\Eloquent\EloquentBrandRepository(new \Modules\Portfolio\Entities\Brand());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Portfolio\Repositories\Cache\CacheBrandDecorator($repository);
            }
        );
    }
}
