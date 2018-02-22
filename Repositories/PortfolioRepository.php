<?php

namespace Modules\Portfolio\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface PortfolioRepository extends BaseRepository
{
    public function latest($amount=10);
}
