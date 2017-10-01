<?php

namespace Modules\Portfolio\Events\Portfolio;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class PortfolioIsCreating extends AbstractEntityHook implements EntityIsChanging
{

}