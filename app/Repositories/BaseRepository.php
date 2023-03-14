<?php

namespace App\Repositories;


abstract class BaseRepository {

    abstract public function create(array $data);
    abstract public function update($model, array $data);
    abstract public function delete($model);
}
