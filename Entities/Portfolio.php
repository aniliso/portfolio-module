<?php

namespace Modules\Portfolio\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Media\Support\Traits\MediaRelation;
use Carbon\Carbon;
use Modules\Portfolio\Presenters\PortfolioPresenter;
use Modules\Tag\Contracts\TaggableInterface;
use Modules\Tag\Traits\TaggableTrait;

class Portfolio extends Model implements TaggableInterface
{
    use Translatable, MediaRelation, PresentableTrait, TaggableTrait, NamespacedEntity;

    protected $table = 'portfolio__portfolios';
    public $translatedAttributes = ['title', 'slug', 'description', 'meta_title', 'meta_description'];
    protected $fillable = ['category_id', 'brand_id', 'title', 'slug', 'description', 'meta_title', 'meta_description', 'website', 'ordering', 'status', 'start_at', 'end_at', 'settings'];
    protected $dates = ['start_at', 'end_at'];
    protected $with = ['brand', 'category'];

    protected static $entityNamespace = 'asgardcms/portfolio';

    protected $presenter = PortfolioPresenter::class;

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'portfolio__portfolio_categories');
    }

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

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('portfolio.slug', [$this->slug]);
    }

    public function setSettingsAttribute($value)
    {
        return $this->attributes['settings'] = json_encode($value);
    }

    public function getSettingsAttribute()
    {
        $settings = json_decode($this->attributes['settings']);
        return $settings;
    }

    public function hasImage()
    {
        return $this->files()->exists();
    }
}
