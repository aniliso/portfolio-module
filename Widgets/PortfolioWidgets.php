<?php namespace Modules\Portfolio\Widgets;

use Modules\Portfolio\Repositories\BrandRepository;
use Modules\Portfolio\Repositories\PortfolioRepository;

class PortfolioWidgets
{
    private $portfolio;
    /**
     * @var BrandRepository
     */
    private $brand;

    public function __construct(PortfolioRepository $portfolio, BrandRepository $brand)
    {
        $this->portfolio = $portfolio;
        $this->brand = $brand;
    }

    public function latest($limit=10) {
        $portfolios = $this->portfolio->latest($limit);
        return view('portfolio::widgets.latest', compact('portfolios'));
    }

    public function brands($limit=10, $view="brand") {
        $brands = $this->brand->all()->where('status', 1)->take($limit)->sortBy('ordering');
        if($brands->count()>0) {
            return view('portfolio::widgets.'.$view, compact('brands'));
        }
        return null;
    }

    public function groups($limit=10, $view='groups') {
        $groups = $this->portfolio->all()
            ->sortBy('ordering')
            ->groupBy('settings.groups')
            ->take($limit);
        return view('portfolio::widgets.'.$view, compact('groups'));
    }
}