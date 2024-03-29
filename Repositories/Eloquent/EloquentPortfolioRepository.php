<?php

namespace Modules\Portfolio\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Modules\Portfolio\Events\Portfolio\PortfolioIsCreating;
use Modules\Portfolio\Events\Portfolio\PortfolioIsUpdating;
use Modules\Portfolio\Events\Portfolio\PortfolioWasCreated;
use Modules\Portfolio\Events\Portfolio\PortfolioWasDeleted;
use Modules\Portfolio\Events\Portfolio\PortfolioWasUpdated;
use Modules\Portfolio\Repositories\PortfolioRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentPortfolioRepository extends EloquentBaseRepository implements PortfolioRepository
{
    public function paginate($perPage = 15)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->orderBy('created_at', 'DESC')->paginate($perPage);
        }

        return $this->model->orderBy('ordering', 'ASC')->paginate($perPage);
    }

    public function all()
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->withTransRelated()->orderBy('created_at', 'DESC')->get();
        }

        return $this->model->orderBy('created_at', 'DESC')->withRelated()->get();
    }

    public function findBySlug($slug)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->whereHas('translations', function (Builder $q) use ($slug) {
                $q->where('slug', $slug);
            })->withTransRelated()->first();
        }

        return $this->model->where('slug', $slug)->withRelated()->first();
    }


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
        return $this->model->whereStatus(1)->orderBy('ordering', 'asc')->withTransRelated()->take($amount)->get();
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

    public function getBySetting($option, $limit)
    {
        return $this->model->where($option, 1)
                           ->take($limit)->get();
    }
}
