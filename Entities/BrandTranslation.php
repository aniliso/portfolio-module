<?php

namespace Modules\Portfolio\Entities;

use Illuminate\Database\Eloquent\Model;

class BrandTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'slug'];
    protected $table = 'portfolio__brand_translations';
}
