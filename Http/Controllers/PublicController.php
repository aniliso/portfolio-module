<?php

namespace Modules\Portfolio\Http\Controllers;

use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Portfolio\Repositories\CategoryRepository;
use Modules\Portfolio\Repositories\PortfolioRepository;

class PublicController extends BasePublicController
{
    /**
     * @var PortfolioRepository
     */
    private $portfolio;
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(PortfolioRepository $portfolio, CategoryRepository $category)
    {
        parent::__construct();
        $this->portfolio = $portfolio;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function portfolioIndex()
    {
        $portfolios = $this->portfolio->all()->sortBy('ordering');

        $this->seo()->setTitle(trans('themes::portfolio.title.meta_title'))
                    ->setDescription(trans('themes::portfolio.title.meta_description'));

        return view('portfolio::index', compact('portfolios'));
    }

    public function portfolioView($slug)
    {
        $portfolio = $this->portfolio->findBySlug($slug);

        if(is_null($portfolio)) abort(404);

        $this->seo()->setTitle($portfolio->title)
                    ->setDescription($portfolio->meta_description)
                    ->meta()
                    ->setUrl($portfolio->url)
                    ->addAlternates($portfolio->present()->languages);

        $this->seoGraph()
            ->setTitle($portfolio->title)
            ->setDescription($portfolio->meta_description)
            ->setImage($portfolio->present()->og_image)
            ->setUrl($portfolio->url);

        return view('portfolio::show', compact('portfolio'));
    }

    public function categoryView($slug)
    {
        $category = $this->category->findBySlug($slug);

        if(is_null($category)) abort(404);

        $portfolios = $category->portfolios()->get();

        $this->seo()->setTitle($category->title)
                    ->setDescription($category->title)
                    ->meta()
                    ->setUrl($category->url)
                    ->addAlternates($category->present()->languages);

        return view('portfolio::category', compact('category', 'portfolios'));
    }
}
