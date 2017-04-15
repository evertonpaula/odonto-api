<?php

namespace App\Services;

use Exception;

abstract class Service {

    protected function throw(Exception $e, $message = null) {
        if ( env('APP_ENV') != 'production' ) {
            throw new Exception(sprintf("%s - Line %s | File %s", $e->getMessage(), $e->getLine(), $e->getFile()));
        } else {
            throw new Exception(sprintf("%s", $message ?:$e->getMessage()));
        }
    }
}
