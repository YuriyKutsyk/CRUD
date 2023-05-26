<?php

namespace App\Repositories\User;

use App\Repositories\Base\BaseRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository extends BaseRepository
{
    protected function query(): Builder
    {
        return User::query();
    }

    public function create(array $attributes): Builder|User
    {
        return $this->query()->create($attributes);
    }

    public function deleteById(int $id): bool
    {
        return $this
            ->query()
            ->where('id', $id)
            ->delete();
    }

    public function updateById(array $attributes, int $id): int
    {
        return $this
            ->query()
            ->where('id', $id)
            ->update($attributes);
    }
}
