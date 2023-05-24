<?php

namespace App\Repositories\User;

use App\Repositories\Base\BaseRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class UserRepository extends BaseRepository
{
    protected function query(): Builder
    {
        return User::query();
    }

    public function create(array $attributes): User
    {
        return $this->query()->create($attributes);
    }

    public function get(
        array $relations = [],
        array $columns = ['*'],
        ?string $sortBy = null,
        ?string $sortDirection = 'ASC',
    ): EloquentCollection {
        return $this->query()
            ->when($sortBy !== null, fn($query) => $query->orderBy($sortBy, $sortDirection))
            ->with($relations)
            ->get($columns);
    }

    public function updateOrCreate(array $attributes): User
    {
        return $this
            ->query()
            ->updateOrCreate($attributes);
    }

    public function deleteById(int $id): int
    {
        return $this
            ->query()
            ->where('id', $id)
            ->delete();
    }
}
