<?php

namespace App\Repositories\Eloquent;


abstract class Repository {

    protected $model;

    public function getModel() {
        return $this->model;
    }

    public function find($id) {
        return $this->model->find((int) $id);
    }

    public function delete($id) {
        return $this->find($id)->delete();
    }

    public function forceDelete($id) {
        return $this->find($id)->forceDelete();
    }

    public function update(array $values = [], $id = null) {
        if ( $id ) return $this->find($id)->fill($values);
        return $this->model->fill($values);
    }

    public function fill(array $values = [], $id = null) {
        if ( $id ) return $this->find($id)->fill($values);
        return $this->model->fill($values);
    }

    public function newInstance() {
        return $this->model->newInstance();
    }
}
