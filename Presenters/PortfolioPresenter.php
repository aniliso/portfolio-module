<?php

namespace Modules\Portfolio\Presenters;

use Modules\Core\Presenters\BasePresenter;

class PortfolioPresenter extends BasePresenter
{
    protected $zone     = 'portfolioImage';
    protected $slug     = 'slug';
    protected $transKey = 'course::routes.portfolio.slug';
    protected $routeKey = 'portfolio.slug';

    public function brandImage($width, $height, $mode, $quality)
    {
        if($file = $this->entity->files()->where('zone', 'portfolioLogo')->first()) {
            return \Imagy::getImage($file->filename, $this->zone, ['width' => $width, 'height' => $height, 'mode' => $mode, 'quality' => $quality]);
        }
        return false;
    }
}