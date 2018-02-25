<?php

namespace Modules\Portfolio\Widgets;

use Modules\Portfolio\Repositories\PortfolioRepository;

class LatestWidget
{
    /**
     * @var PortfolioRepository
     */
    private $portfolio;

    public function __construct(PortfolioRepository $portfolio)
    {
        $this->portfolio = $portfolio;
    }

    public function register($limit=10) {
        $portfolios = $this->portfolio->latest($limit);
        return view('portfolio::widgets.latest', compact('portfolios'))->render();
    }
}