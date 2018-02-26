<?php

namespace Modules\Portfolio\Entities;

use Illuminate\Database\Eloquent\Model;

class PortfolioTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'slug', 'description', 'meta_title', 'meta_description'];
    protected $table = 'portfolio__portfolio_translations';

    public function getTitleAttribute()
    {
        return $this->attributes['meta_title'] ? $this->attributes['meta_title'] : $this->attributes['title'];
    }
}
