<?php

namespace Modules\Portfolio\Composers\Backend;


use Illuminate\Contracts\View\View;
use Modules\Portfolio\Repositories\BrandRepository;

class BrandComposer
{
    private $brand;

    public function __construct(BrandRepository $brand)
    {
        $this->brand = $brand;
    }

    public function compose(View $view)
    {
        $brands = $this->brand->all()->pluck('title', 'id')->toArray();
        $view->with('selectBrands', $brands);
    }
}