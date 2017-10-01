<?php

namespace Modules\Portfolio\Events\Brand;

use Modules\Media\Contracts\StoringMedia;
use Modules\Portfolio\Entities\Brand;

class BrandWasUpdated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Brand
     */
    public $brand;

    public function __construct(Brand $post, array $data)
    {
        $this->data = $data;
        $this->brand = $post;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->brand;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}
