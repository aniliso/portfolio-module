<?php namespace Modules\Portfolio\Widgets;

use Modules\Portfolio\Repositories\BrandRepository;
use Modules\Portfolio\Repositories\CategoryRepository;
use Modules\Portfolio\Repositories\PortfolioRepository;

class PortfolioWidgets
{
    private $portfolio;
    /**
     * @var BrandRepository
     */
    private $brand;
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(PortfolioRepository $portfolio, BrandRepository $brand, CategoryRepository $category)
    {
        $this->portfolio = $portfolio;
        $this->brand = $brand;
        $this->category = $category;
    }

    public function latest($limit=10, $option='') {
        $portfolios = $this->portfolio->getBySetting($option, $limit);
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

    public function categories($view='categories', $limit=20) {
        $categories = $this->category->all()->sortBy('ordering')->take($limit);
        return view('portfolio::widgets.'.$view, compact('categories'));
    }
}
