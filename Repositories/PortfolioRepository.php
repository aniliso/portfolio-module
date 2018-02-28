<?php

namespace Modules\Portfolio\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface PortfolioRepository extends BaseRepository
{
    /**
     * @param int $amount
     * @return mixed
     */
    public function latest($amount=10);

    /**
     * Get the previous post of the given post
     * @param object $portfolio
     * @return object
     */
    public function getPreviousOf($portfolio);

    /**
     * Get the next post of the given post
     * @param object $portfolio
     * @return object
     */
    public function getNextOf($portfolio);
}
