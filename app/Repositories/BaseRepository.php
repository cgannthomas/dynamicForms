<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository.
 *
 * @package namespace App\Repositories;
 */
class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }
}
