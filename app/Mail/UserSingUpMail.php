<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserSingUpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $users;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $users)
    {
       $this->users = $users; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
     
        ->subject(config('app.name') . ' - Kullanıcı Kaydı')
        ->view('Mails.usersingup');
    }
}