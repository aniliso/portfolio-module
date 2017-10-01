<?php

namespace Modules\Portfolio\Events\Brand;

use Modules\Media\Contracts\DeletingMedia;

class BrandWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    private $brandClass;
    /**
     * @var int
     */
    private $brandId;

    public function __construct($brandId, $brandClass)
    {
        $this->brandClass = $brandClass;
        $this->brandId = $brandId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->brandId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->brandClass;
    }
}
