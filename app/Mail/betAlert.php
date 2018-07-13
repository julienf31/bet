<?php

namespace App\Mail;

use App\Game;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class betAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $game;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Game $game,User $user)
    {
        $this->game = $game;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.betReminder', compact('user','game'));
    }
}
