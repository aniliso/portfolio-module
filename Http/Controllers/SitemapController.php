<?php

namespace Modules\Portfolio\Http\Controllers;

use Modules\Portfolio\Repositories\PortfolioRepository;
use Modules\Sitemap\Http\Controllers\BaseSitemapController;

class SitemapController extends BaseSitemapController
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

    public function index()
    {
        $portfolios = $this->portfolio->allTranslatedIn(locale());
        foreach ($portfolios as $portfolio) {
            $images = [];
            if($portfolio->hasImage())
            {
                $images[] = ['url' => url($portfolio->present()->firstImage(500,null,'resize',80)), 'title' => $portfolio->title];
            }
            $this->sitemap->add(
                $portfolio->url,
                $portfolio->updated_at,
                '0.9',
                'weekly',
                $images,
                null,
                $portfolio->present()->languages('language', 'url', true)
            );
        }
        return $this->sitemap->render('xml');
    }
}
