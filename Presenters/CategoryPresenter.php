<?php

namespace Modules\Portfolio\Presenters;

use Modules\Core\Presenters\BasePresenter;

class CategoryPresenter extends BasePresenter
{
    protected $zone     = 'portfolioCategoryImage';
    protected $slug     = 'slug';
    protected $transKey = 'portfolio::routes.category.slug';
    protected $routeKey = 'brand.slug';
}