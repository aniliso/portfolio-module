<?php

namespace Modules\Portfolio\Events\Portfolio;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;
use Modules\Portfolio\Entities\Portfolio;

class PortfolioIsUpdating extends AbstractEntityHook implements EntityIsChanging
{
    private $portfolio;

    public function __construct(Portfolio $portfolio, array $attributes)
    {
        $this->portfolio = $portfolio;
        parent::__construct($attributes);
    }

    public function getCategory()
    {
        return $this->portfolio;
    }
}