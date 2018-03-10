<?php

namespace Modules\Portfolio\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Portfolio\Repositories\CategoryRepository;
use Modules\Portfolio\Repositories\PortfolioRepository;
use Breadcrumbs;

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

    /**
     * PublicController constructor.
     * @param PortfolioRepository $portfolio
     * @param CategoryRepository $category
     */
    public function __construct(PortfolioRepository $portfolio, CategoryRepository $category)
    {
        parent::__construct();
        $this->portfolio = $portfolio;
        $this->category = $category;

        /* Start Default Breadcrumbs */
        if(!app()->runningInConsole()) {
            Breadcrumbs::register('portfolio.index', function ($breadcrumbs) {
                $breadcrumbs->push(trans('themes::portfolio.title.portfolios'), route('portfolio.index'));
            });
        }
        /* End Default Breadcrumbs */
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

        /* Start Breadcrumbs */
        Breadcrumbs::register('portfolio.view', function($breadcrumbs) use ($portfolio) {
            $breadcrumbs->parent('portfolio.index');
            if(isset($portfolio->category)) $breadcrumbs->push($portfolio->category->title, $portfolio->category->url);
            $breadcrumbs->push($portfolio->title, $portfolio->url);
        });
        /* End Breadcrumbs */

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

        /* Start Breadcrumbs */
        Breadcrumbs::register('portfolio.category', function($breadcrumbs) use ($category) {
            $breadcrumbs->parent('portfolio.index');
            $breadcrumbs->push($category->title, $category->url);
        });
        /* End Breadcrumbs */

        return view('portfolio::category', compact('category', 'portfolios'));
    }
}
