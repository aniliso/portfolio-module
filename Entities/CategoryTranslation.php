<?php

namespace Modules\Portfolio\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'slug'];
    protected $table = 'portfolio__category_translations';

    public function getUrlAttribute()
    {
        return localize_trans_url($this->locale, 'portfolio::routes.category.slug', ['slug'=>$this->slug]);
    }
}
