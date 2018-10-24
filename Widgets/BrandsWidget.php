<?php

namespace Modules\Portfolio\Widgets;


use Modules\Portfolio\Repositories\BrandRepository;

class BrandsWidget
{
    protected $brand;

    public function __construct(BrandRepository $brand)
    {
        $this->brand = $brand;
    }

    public function register($limit=10, $view='brand') {
        $brands = $this->brand->all()->where('status', 1)->take($limit)->sortBy('ordering');
        return view('portfolio::widgets.'.$view, compact('brands'))->render();
    }
}