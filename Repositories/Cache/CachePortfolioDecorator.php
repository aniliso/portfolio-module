<?php

namespace Modules\Portfolio\Repositories\Cache;

use Modules\Portfolio\Repositories\PortfolioRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePortfolioDecorator extends BaseCacheDecorator implements PortfolioRepository
{
    public function __construct(PortfolioRepository $portfolio)
    {
        parent::__construct();
        $this->entityName = 'portfolio.portfolios';
        $this->repository = $portfolio;
    }

    /**
     * Return the latest x blog posts
     * @param int $amount
     * @return Collection
     */
    public function latest($amount = 5)
    {
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember("{$this->locale}.{$this->entityName}.latest.{$amount}", $this->cacheTime,
                function () use ($amount) {
                    return $this->repository->latest($amount);
                }
            );
    }
}
