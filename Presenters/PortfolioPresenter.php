<?php

namespace Modules\Portfolio\Presenters;

use Modules\Core\Presenters\BasePresenter;
use Modules\Portfolio\Repositories\PortfolioRepository;

class PortfolioPresenter extends BasePresenter
{
    protected $zone     = 'portfolioImage';
    protected $slug     = 'slug';
    protected $transKey = 'portfolio::routes.portfolio.slug';
    protected $routeKey = 'portfolio.slug';
    protected $portfolio;

    public function __construct($entity)
    {
        parent::__construct($entity);

        $this->portfolio   = app(PortfolioRepository::class);
    }

    public function brandImage($width, $height, $mode, $quality)
    {
        if($file = $this->entity->files()->where('zone', 'portfolioLogo')->first()) {
            return \Imagy::getImage($file->filename, $this->zone, ['width' => $width, 'height' => $height, 'mode' => $mode, 'quality' => $quality]);
        }
        return false;
    }

    public function previous()
    {
        return $this->portfolio->getPreviousOf($this->entity);
    }

    public function next()
    {
        return $this->portfolio->getNextOf($this->entity);
    }
}