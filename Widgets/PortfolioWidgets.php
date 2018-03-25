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

    public function brands($limit=10) {
        $brands = $this->brand->all()->where('status', 1)->take($limit)->sortBy('ordering');
        return view('portfolio::widgets.brand', compact('brands'));
    }

    public function groups($limit=10, $view='groups') {
        $groups = $this->portfolio->all()
            ->where('settings.group', '!=', '')
            ->groupBy('settings.group')
            ->sort()
            ->take($limit);
        return view('portfolio::widgets.'.$view, compact('groups'));
    }
}