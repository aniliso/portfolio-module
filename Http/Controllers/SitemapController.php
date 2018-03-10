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
        ob_start();
        $portfolios = $this->portfolio->allTranslatedIn(locale());
        foreach ($portfolios as $portfolio) {
            $images = []; $i = 1;
            if($portfolio->hasImage()) {
                if($allImages = $portfolio->present()->images(500,null,'resize',80)) {
                    if(is_array($allImages)) {
                        foreach ($allImages as $image) {
                            $images[] = ['url' => url($image), 'title' => $portfolio->title.' '.$i++];
                        }
                    }
                } else {
                    $images[] = ['url' => url($portfolio->present()->firstImage(500,null,'resize',80)), 'title' => $portfolio->title];
                }
            }
            $this->sitemap->add(
                $portfolio->url,
                $portfolio->updated_at,
                '1.0',
                'daily',
                $images,
                null,
                $portfolio->present()->languages('language', 'url', true)
            );
        }
        ob_end_flush();
        return $this->sitemap->render('xml');
    }
}
