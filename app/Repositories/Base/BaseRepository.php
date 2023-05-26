<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository
{
    abstract protected function query(): Builder;
}
