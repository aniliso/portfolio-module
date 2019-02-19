<?php

namespace Modules\Portfolio\Entities;

use Illuminate\Database\Eloquent\Model;

class BrandTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'slug'];
    protected $table = 'portfolio__brand_translations';

    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return localize_trans_url($this->locale, 'portfolio::routes.brand.slug', ['slug'=>$this->slug]);
    }
}
