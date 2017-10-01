<?php

namespace Modules\Portfolio\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;
use Carbon\Carbon;

class Portfolio extends Model
{
    use Translatable, MediaRelation;

    protected $table = 'portfolio__portfolios';
    public $translatedAttributes = ['title', 'slug', 'description', 'meta_title', 'meta_description'];
    protected $fillable = ['category_id', 'brand_id', 'title', 'slug', 'description', 'meta_title', 'meta_description', 'website', 'ordering', 'status', 'start_at', 'end_at'];
    protected $dates = ['start_at', 'end_at'];

    public function setStartAtAttribute($value)
    {
        return $this->attributes['start_at'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function setEndAtAttribute($value)
    {
        return $this->attributes['end_at'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
