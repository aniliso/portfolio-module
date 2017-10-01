<?php

namespace Modules\Portfolio\Repositories\Eloquent;

use Modules\Portfolio\Events\Category\CategoryWasCreated;
use Modules\Portfolio\Events\Category\CategoryWasDeleted;
use Modules\Portfolio\Events\Category\CategoryWasUpdated;
use Modules\Portfolio\Repositories\CategoryRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentCategoryRepository extends EloquentBaseRepository implements CategoryRepository
{
    public function create($data)
    {
        $model = $this->model->create($data);

        event(new CategoryWasCreated($model, $data));

        return $model;
    }

    public function update($model, $data)
    {
        $model->update($data);

        event(new CategoryWasUpdated($model, $data));

        return $model;
    }

    public function destroy($model)
    {
        event(new CategoryWasDeleted($model->id, get_class($model)));

        return $model->delete();
    }

}
