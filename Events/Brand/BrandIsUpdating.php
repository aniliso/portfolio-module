<?php

namespace Modules\Portfolio\Events\Brand;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;
use Modules\Portfolio\Entities\Brand;

class BrandIsUpdating extends AbstractEntityHook implements EntityIsChanging
{
    private $brand;

    public function __construct(Brand $brand, array $attributes)
    {
        $this->brand = $brand;
        parent::__construct($attributes);
    }

    public function getBrand()
    {
        return $this->brand;
    }
}