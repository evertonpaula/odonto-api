<?php

namespace App\Mail\User;

use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SingUp extends Mailable {

    use Queueable, SerializesModels;

    protected $user;

    public function __construct(User $user) {
       $this->user = $user;
    }

    public function build() {
       return $this->view('mail.user.singup')
                   ->with([
                       'today' => date('d-m-Y H:i:s'),
                       'name' => $this->user->name,
                       'link_activated' => sprintf("%s/activated/%s", config('front.url'), $this->user->uuid)
                   ]);
    }
}
