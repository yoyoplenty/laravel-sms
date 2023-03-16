<?php

namespace App\Repositories;

use App\Exceptions\ErrorResponse;
use App\Repositories\BaseInterface;
use Exception;

class BaseRepository implements BaseInterface {

    protected $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function create($data) {
        try {
            return $this->model->create($data);
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }

    public function paginate() {
        try {
            return $this->model->paginate();
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }

    public function findAll() {
        try {
            return $this->model->all();
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }

    public function find($query) {
        try {
            $data = $this->model->find($query);
            if (!$data) throw new ErrorResponse('data not found');

            return $data;
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }

    public function findById($id) {
        try {
            $data = $this->model->find($id);
            if (!$data) throw new ErrorResponse('data not found');

            return $data;
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }

    public function update($id, $data) {
        try {
            $entity = $this->model->find($id);
            if (!$entity) throw new ErrorResponse('data not found');

            $entity->update($data);
            return $entity;
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }

    public function delete($id) {
        try {
            $data = $this->model->find($id);
            if (!$data) throw new ErrorResponse('data not found');


            return $data->delete();
        } catch (Exception $ex) {
            throw new ErrorResponse($ex->getMessage());
        }
    }
}
