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

    /**
     * Get the next post of the given post
     * @param object $portfolio
     * @return object
     */
    public function getNextOf($portfolio)
    {
        $portfolioId = $portfolio->id;

        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember("{$this->locale}.{$this->entityName}.getNextOf.{$portfolioId}", $this->cacheTime,
                function () use ($portfolio) {
                    return $this->repository->getNextOf($portfolio);
                }
            );
    }

    /**
     * Get the next post of the given post
     * @param object $portfolio
     * @return object
     */
    public function getPreviousOf($portfolio)
    {
        $portfolioId = $portfolio->id;

        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember("{$this->locale}.{$this->entityName}.getPreviousOf.{$portfolioId}", $this->cacheTime,
                function () use ($portfolio) {
                    return $this->repository->getNextOf($portfolio);
                }
            );
    }

    public function getBySetting($option, $limit)
    {
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember("{$this->locale}.{$this->entityName}.getBySetting.{$option}.{$limit}", $this->cacheTime,
                function () use ($option, $limit) {
                    return $this->repository->getBySetting($option, $limit);
                }
            );
    }
}
