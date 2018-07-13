<?php

namespace App\Jobs;

use App\Bet;
use App\Game;
use App\Mail\betAlert;
use App\Match;
use App\Participant;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class betAlertMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $games = Game::all();
        foreach($games as $game){
             if(true){
                $users = $game->participants;
                $day = $game->tournament->currentDay;
                $matches = Match::where('tournament_id', $game->tournament->id)->where('days', $day)->select('id')->get();
                $nbBet = $game->tournament->participants/2;
                foreach ($users as $user){
                    $u = User::find($user->user_id);
                    $userBets = Bet::where('user_id', $u->id)->where('game_id', $game->id)->whereIn('match_id', $matches)->count();
                    if($userBets < $nbBet){
                        //send mail to complete bets
                        Mail::to($u)->send(new betAlert($game,$u));
                    }
                }
            }
        }
    }
}
