<?php

namespace Modules\Portfolio\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Portfolio\Entities\Brand;
use Modules\Portfolio\Http\Requests\CreateBrandRequest;
use Modules\Portfolio\Http\Requests\UpdateBrandRequest;
use Modules\Portfolio\Repositories\BrandRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class BrandController extends AdminBaseController
{
    /**
     * @var BrandRepository
     */
    private $brand;

    public function __construct(BrandRepository $brand)
    {
        parent::__construct();

        $this->brand = $brand;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $brands = $this->brand->all();

        return view('portfolio::admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('portfolio::admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateBrandRequest $request
     * @return Response
     */
    public function store(CreateBrandRequest $request)
    {
        $this->brand->create($request->all());

        return redirect()->route('admin.portfolio.brand.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('portfolio::brands.title.brands')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Brand $brand
     * @return Response
     */
    public function edit(Brand $brand)
    {
        return view('portfolio::admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Brand $brand
     * @param  UpdateBrandRequest $request
     * @return Response
     */
    public function update(Brand $brand, UpdateBrandRequest $request)
    {
        $this->brand->update($brand, $request->all());

        return redirect()->route('admin.portfolio.brand.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('portfolio::brands.title.brands')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Brand $brand
     * @return Response
     */
    public function destroy(Brand $brand)
    {
        $this->brand->destroy($brand);

        return redirect()->route('admin.portfolio.brand.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('portfolio::brands.title.brands')]));
    }
}