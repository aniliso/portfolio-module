<?php namespace Modules\Portfolio\Entities;

use Illuminate\Database\Eloquent\Model;

class PortfolioCategory extends Model
{
    public $timestamps  = false;
    protected $table    = 'portfolio__portfolio_categories';
    protected $fillable = ['portfolio_id', 'category_id'];

    public function getUrlAttribute()
    {
        return localize_trans_url($this->locale, 'portfolio::routes.category.slug', ['slug'=>$this->slug]);
    }
}
