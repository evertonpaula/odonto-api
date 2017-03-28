<?php

namespace App\Mail;

use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Exception;

class Dispacher {

   public static function send($mailable, $to, array $args = null) {
       try {
          Mail::to($to)->send($mailable);
       } catch (Exception $e) {
           throw new Exception($e->getMessage(), $e->getCode());
       }
   }

   public static function later($mailable, $to, array $args = null) {
       try {
          $when = Carbon::now()->addMinutes(1);
          Mail::to($to)->later($when, $mailable);
       } catch (Exception $e) {
           throw new Exception($e->getMessage(), $e->getCode());
       }
   }
}
