<?php

namespace Modules\Portfolio\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Portfolio\Presenters\CategoryPresenter;

class Category extends Model
{
    use Translatable, MediaRelation, PresentableTrait;

    protected $table = 'portfolio__categories';
    public $translatedAttributes = ['title', 'slug'];
    protected $fillable = ['title', 'slug', 'ordering', 'status'];
    protected $presenter = CategoryPresenter::class;

    public function portfolios()
    {
        return $this->belongsToMany(Portfolio::class, 'portfolio__portfolio_categories');
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('portfolio.category.slug', [$this->slug]);
    }
}
