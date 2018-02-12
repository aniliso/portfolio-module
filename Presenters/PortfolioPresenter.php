<?php

namespace Modules\Portfolio\Presenters;

use Modules\Core\Presenters\BasePresenter;

class PortfolioPresenter extends BasePresenter
{
    protected $zone     = 'portfolioImage';
    protected $slug     = 'slug';
    protected $transKey = 'course::routes.portfolio.slug';
    protected $routeKey = 'portfolio.slug';
}