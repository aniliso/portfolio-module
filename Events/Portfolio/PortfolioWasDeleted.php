<?php

namespace Modules\Portfolio\Events\Portfolio;

use Modules\Media\Contracts\DeletingMedia;

class PortfolioWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    private $portfolioClass;
    /**
     * @var int
     */
    private $portfolioId;

    public function __construct($portfolioId, $portfolioClass)
    {
        $this->portfolioClass = $portfolioClass;
        $this->portfolioId = $portfolioId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->portfolioId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->portfolioClass;
    }
}
