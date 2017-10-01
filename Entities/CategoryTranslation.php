<?php

namespace Modules\Portfolio\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'slug'];
    protected $table = 'portfolio__category_translations';
}
