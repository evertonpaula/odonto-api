<?php

namespace App\Mail\User;

use App\Models\User\RecoverPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPassword extends Mailable {

    use Queueable, SerializesModels;

    protected $recover;

    public function __construct(RecoverPassword $recover) {
       $this->recover = $recover;
    }

    public function build() {
       return $this->view('mail.user.forget-password')
                   ->with([
                       'today' => date(env('DATE_TIME_FORMAT')),
                       'name' => $this->recover->user->name,
                       'expire_at' => $this->recover->expire_at->format(env('DATE_TIME_FORMAT')),
                       'link_recover' => sprintf("%s/recover/%s", config('front.url'), $this->recover->token)
                   ]);
    }
}
