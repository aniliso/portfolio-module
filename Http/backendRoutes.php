<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/portfolio'], function (Router $router) {
    $router->bind('portfolio', function ($id) {
        return app('Modules\Portfolio\Repositories\PortfolioRepository')->find($id);
    });
    $router->get('portfolios', [
        'as' => 'admin.portfolio.portfolio.index',
        'uses' => 'PortfolioController@index',
        'middleware' => 'can:portfolio.portfolios.index'
    ]);
    $router->get('portfolios/create', [
        'as' => 'admin.portfolio.portfolio.create',
        'uses' => 'PortfolioController@create',
        'middleware' => 'can:portfolio.portfolios.create'
    ]);
    $router->post('portfolios', [
        'as' => 'admin.portfolio.portfolio.store',
        'uses' => 'PortfolioController@store',
        'middleware' => 'can:portfolio.portfolios.create'
    ]);
    $router->get('portfolios/{portfolio}/edit', [
        'as' => 'admin.portfolio.portfolio.edit',
        'uses' => 'PortfolioController@edit',
        'middleware' => 'can:portfolio.portfolios.edit'
    ]);
    $router->put('portfolios/{portfolio}', [
        'as' => 'admin.portfolio.portfolio.update',
        'uses' => 'PortfolioController@update',
        'middleware' => 'can:portfolio.portfolios.edit'
    ]);
    $router->delete('portfolios/{portfolio}', [
        'as' => 'admin.portfolio.portfolio.destroy',
        'uses' => 'PortfolioController@destroy',
        'middleware' => 'can:portfolio.portfolios.destroy'
    ]);
    $router->bind('portfolioCategory', function ($id) {
        return app('Modules\Portfolio\Repositories\CategoryRepository')->find($id);
    });
    $router->get('categories', [
        'as' => 'admin.portfolio.category.index',
        'uses' => 'CategoryController@index',
        'middleware' => 'can:portfolio.categories.index'
    ]);
    $router->get('categories/create', [
        'as' => 'admin.portfolio.category.create',
        'uses' => 'CategoryController@create',
        'middleware' => 'can:portfolio.categories.create'
    ]);
    $router->post('categories', [
        'as' => 'admin.portfolio.category.store',
        'uses' => 'CategoryController@store',
        'middleware' => 'can:portfolio.categories.create'
    ]);
    $router->get('categories/{portfolioCategory}/edit', [
        'as' => 'admin.portfolio.category.edit',
        'uses' => 'CategoryController@edit',
        'middleware' => 'can:portfolio.categories.edit'
    ]);
    $router->put('categories/{portfolioCategory}', [
        'as' => 'admin.portfolio.category.update',
        'uses' => 'CategoryController@update',
        'middleware' => 'can:portfolio.categories.edit'
    ]);
    $router->delete('categories/{portfolioCategory}', [
        'as' => 'admin.portfolio.category.destroy',
        'uses' => 'CategoryController@destroy',
        'middleware' => 'can:portfolio.categories.destroy'
    ]);
    $router->bind('portfolioBrand', function ($id) {
        return app('Modules\Portfolio\Repositories\BrandRepository')->find($id);
    });
    $router->get('brands', [
        'as' => 'admin.portfolio.brand.index',
        'uses' => 'BrandController@index',
        'middleware' => 'can:portfolio.brands.index'
    ]);
    $router->get('brands/create', [
        'as' => 'admin.portfolio.brand.create',
        'uses' => 'BrandController@create',
        'middleware' => 'can:portfolio.brands.create'
    ]);
    $router->post('brands', [
        'as' => 'admin.portfolio.brand.store',
        'uses' => 'BrandController@store',
        'middleware' => 'can:portfolio.brands.create'
    ]);
    $router->get('brands/{portfolioBrand}/edit', [
        'as' => 'admin.portfolio.brand.edit',
        'uses' => 'BrandController@edit',
        'middleware' => 'can:portfolio.brands.edit'
    ]);
    $router->put('brands/{portfolioBrand}', [
        'as' => 'admin.portfolio.brand.update',
        'uses' => 'BrandController@update',
        'middleware' => 'can:portfolio.brands.edit'
    ]);
    $router->delete('brands/{portfolioBrand}', [
        'as' => 'admin.portfolio.brand.destroy',
        'uses' => 'BrandController@destroy',
        'middleware' => 'can:portfolio.brands.destroy'
    ]);
// append



});
