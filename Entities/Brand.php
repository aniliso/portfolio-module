<?php

namespace Modules\Portfolio\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Portfolio\Presenters\BrandPresenter;

class Brand extends Model
{
    use Translatable, MediaRelation, PresentableTrait;

    protected $table = 'portfolio__brands';
    public $translatedAttributes = ['title', 'slug'];
    protected $fillable = ['title', 'slug', 'website', 'status', 'ordering'];
    protected $presenter = BrandPresenter::class;

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function getUrlAttribute()
    {
        return localize_trans_url(locale(), 'portfolio::routes.brand.slug', ['slug'=>$this->slug]);
    }
}
