<?php

namespace Modules\Portfolio\Repositories\Eloquent;

use Modules\Portfolio\Events\Portfolio\PortfolioIsCreating;
use Modules\Portfolio\Events\Portfolio\PortfolioIsUpdating;
use Modules\Portfolio\Events\Portfolio\PortfolioWasCreated;
use Modules\Portfolio\Events\Portfolio\PortfolioWasDeleted;
use Modules\Portfolio\Events\Portfolio\PortfolioWasUpdated;
use Modules\Portfolio\Repositories\PortfolioRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentPortfolioRepository extends EloquentBaseRepository implements PortfolioRepository
{
    public function create($data)
    {
        event($event = new PortfolioIsCreating($data));

        $model = $this->model->create($event->getAttributes());

        event(new PortfolioWasCreated($model, $data));

        $model->setTags(array_get($data, 'tags', []));

        return $model;
    }

    public function update($model, $data)
    {
        event($event = new PortfolioIsUpdating($model, $data));

        $model->update($event->getAttributes());

        event(new PortfolioWasUpdated($model, $data));

        $model->setTags(array_get($data, 'tags', []));

        return $model;
    }

    public function destroy($model)
    {
        event(new PortfolioWasDeleted($model->id, get_class($model)));

        return $model->delete();
    }

    public function latest($amount = 10)
    {
        return $this->model->whereStatus(1)->orderBy('ordering', 'asc')->with('translations')->take($amount)->get();
    }

    /**
     * Get the previous post of the given post
     * @param object $portfolio
     * @return object
     */
    public function getPreviousOf($portfolio)
    {
        return $this->model->where('created_at', '<', $portfolio->created_at)
            ->whereStatus(1)->orderBy('created_at', 'desc')->first();
    }

    /**
     * Get the next post of the given post
     * @param object $portfolio
     * @return object
     */
    public function getNextOf($portfolio)
    {
        return $this->model->where('created_at', '>', $portfolio->created_at)
            ->whereStatus(1)->first();
    }
}
