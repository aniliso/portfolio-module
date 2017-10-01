<?php

namespace Modules\Portfolio\Events\Portfolio;

use Modules\Portfolio\Entities\Portfolio;
use Modules\Media\Contracts\StoringMedia;

class PortfolioWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Portfolio
     */
    public $portfolio;

    public function __construct($portfolio, array $data)
    {
        $this->data = $data;
        $this->portfolio = $portfolio;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->portfolio;
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
