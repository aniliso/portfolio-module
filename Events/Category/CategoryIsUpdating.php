<?php

namespace Modules\Portfolio\Events\Category;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;
use Modules\Portfolio\Entities\Category;

class CategoryIsUpdating extends AbstractEntityHook implements EntityIsChanging
{
    private $category;

    public function __construct(Category $category, array $attributes)
    {
        $this->category = $category;
        parent::__construct($attributes);
    }

    public function getCategory()
    {
        return $this->category;
    }
}