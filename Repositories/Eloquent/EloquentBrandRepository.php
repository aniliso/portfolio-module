<?php

namespace Modules\Portfolio\Repositories\Eloquent;

use Modules\Portfolio\Events\Brand\BrandIsCreating;
use Modules\Portfolio\Events\Brand\BrandIsUpdating;
use Modules\Portfolio\Events\Brand\BrandWasCreated;
use Modules\Portfolio\Events\Brand\BrandWasDeleted;
use Modules\Portfolio\Events\Brand\BrandWasUpdated;
use Modules\Portfolio\Repositories\BrandRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentBrandRepository extends EloquentBaseRepository implements BrandRepository
{
    public function create($data)
    {
        event($event = new BrandIsCreating($data));

        $model = $this->model->create($event->getAttributes());

        event(new BrandWasCreated($model, $data));

        return $model;
    }

    public function update($model, $data)
    {
        event($event = new BrandIsUpdating($model, $data));

        $model->update($event->getAttributes());

        event(new BrandWasUpdated($model, $data));

        return $model;
    }

    public function destroy($model)
    {
        event(new BrandWasDeleted($model->id, get_class($model)));

        return $model->delete();
    }
}
