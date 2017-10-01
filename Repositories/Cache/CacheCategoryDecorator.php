<?php

namespace Modules\Portfolio\Repositories\Cache;

use Modules\Portfolio\Repositories\CategoryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCategoryDecorator extends BaseCacheDecorator implements CategoryRepository
{
    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->entityName = 'portfolio.categories';
        $this->repository = $category;
    }
}
