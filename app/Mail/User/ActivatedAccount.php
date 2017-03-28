<?php

namespace App\Mail\User;

use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivatedAccount extends Mailable {

    use Queueable, SerializesModels;

    protected $user;

    public function __construct(User $user) {
       $this->user = $user;
    }

    public function build() {
       return $this->view('mail.user.activated-account')
                   ->with([
                       'today' => date(env('DATE_TIME_FORMAT')),
                       'name' => $this->user->name,
                   ]);
    }
}
