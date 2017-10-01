<?php

namespace Modules\Portfolio\Repositories\Cache;

use Modules\Portfolio\Repositories\BrandRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheBrandDecorator extends BaseCacheDecorator implements BrandRepository
{
    public function __construct(BrandRepository $brand)
    {
        parent::__construct();
        $this->entityName = 'portfolio.brands';
        $this->repository = $brand;
    }
}
