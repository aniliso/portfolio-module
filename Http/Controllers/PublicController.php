<?php

namespace Modules\Portfolio\Http\Controllers;

use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Portfolio\Repositories\PortfolioRepository;

class PublicController extends BasePublicController
{
    /**
     * @var PortfolioRepository
     */
    private $portfolio;

    public function __construct(PortfolioRepository $portfolio)
    {
        parent::__construct();
        $this->portfolio = $portfolio;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function portfolioIndex()
    {
        $portfolios = $this->portfolio->all();

        $this->seo()->setTitle(trans('themes::portfolio.title.portfolios'));

        return view('portfolio::index', compact('portfolios'));
    }

    public function portfolioView($slug)
    {
        $portfolio = $this->portfolio->findBySlug($slug);

        $this->seo()->setTitle($portfolio->title)
                    ->setDescription($portfolio->meta_description);

        return view('portfolio::show', compact('portfolio'));
    }
}
