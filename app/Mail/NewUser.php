<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUser extends Mailable
{
    use Queueable, SerializesModels;

    public $year; // the year, for the email's footer
    public $user; // the user object

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->year = date("Y");
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(['address' => 'hi@forafter4.ca', 'name' => 'Shrey from ForAfter4'])
            ->subject('Welcome to ForAfter4!')
            ->view('mail.users.new');
    }
}
