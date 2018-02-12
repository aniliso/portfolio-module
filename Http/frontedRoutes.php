<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' =>''], function (Router $router) {
    $router->get(LaravelLocalization::transRoute('portfolio::routes.portfolio.index'), [
        'as'         => 'portfolio.index',
        'uses'       => 'PublicController@portfolioIndex'
    ]);
    $router->get(LaravelLocalization::transRoute('portfolio::routes.portfolio.slug'), [
        'as'         => 'portfolio.slug',
        'uses'       => 'PublicController@portfolioView'
    ]);
    $router->get(LaravelLocalization::transRoute('portfolio::routes.brand.index'), [
        'as'         => 'brand.index',
        'uses'       => 'PublicController@index'
    ]);
    $router->get(LaravelLocalization::transRoute('portfolio::routes.brand.slug'), [
        'as'         => 'brand.slug',
        'uses'       => 'BrandController@brand'
    ]);
});