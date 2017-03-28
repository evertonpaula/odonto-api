<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use App\Models\User\User;
use App\Models\User\RecoverPassword;

class UserRepository extends Repository {

    public function __construct(User $model) {
        $this->model = $model;
    }

    public function getRecoverModel() {
        return new RecoverPassword();
    }
}
