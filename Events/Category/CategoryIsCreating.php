<?php

namespace Modules\Portfolio\Events\Category;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class CategoryIsCreating extends AbstractEntityHook implements EntityIsChanging
{

}