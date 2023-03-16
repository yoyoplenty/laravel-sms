<?php

namespace App\Repositories;


interface BaseInterface {
    public function create($data);
    public function paginate();
    public function findAll();
    public function find($query);
    public function findById($id);
    public function update($id, $data);
    public function delete($id);
}
