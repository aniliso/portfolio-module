<?php

namespace Modules\Portfolio\Presenters;


use Modules\Core\Presenters\BasePresenter;

class BrandPresenter extends BasePresenter
{
    protected $zone     = 'portfolioBrandImage';
    protected $slug     = 'slug';
    protected $transKey = 'course::routes.brand.slug';
    protected $routeKey = 'brand.slug';
}