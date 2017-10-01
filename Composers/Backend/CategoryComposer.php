<?php namespace Modules\Portfolio\Composers\Backend;


use Illuminate\Contracts\View\View;
use Modules\Portfolio\Repositories\CategoryRepository;

class CategoryComposer
{
    private $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function compose(View $view)
    {
        $categories = $this->category->all()->pluck('title', 'id')->toArray();
        $view->with('selectCategories', $categories);
    }
}