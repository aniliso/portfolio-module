<?php

namespace Modules\Portfolio\Presenters;

use Modules\Core\Presenters\BasePresenter;

class CategoryPresenter extends BasePresenter
{
    protected $zone     = 'portfolioCategoryImage';
    protected $slug     = 'slug';
    protected $transKey = 'course::routes.category.slug';
    protected $routeKey = 'brand.slug';
}