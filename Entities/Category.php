<?php

namespace Modules\Portfolio\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class Category extends Model
{
    use Translatable, MediaRelation;

    protected $table = 'portfolio__categories';
    public $translatedAttributes = ['title', 'slug'];
    protected $fillable = ['title', 'slug', 'ordering', 'status'];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
