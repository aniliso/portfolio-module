<?php

namespace Modules\Portfolio\Events\Brand;

use Modules\Portfolio\Entities\Brand;
use Modules\Media\Contracts\StoringMedia;

class BrandWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Brand
     */
    public $brand;

    public function __construct($brand, array $data)
    {
        $this->data = $data;
        $this->brand = $brand;
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
