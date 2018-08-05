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
             if($game->mail){
                $users = $game->participants;
                $day = $game->tournament->currentDay;
                $matchesID = Match::where('tournament_id', $game->tournament->id)->where('days', $day)->select('id')->get();
                $matches = Match::where('tournament_id', $game->tournament->id)->where('days', $day)->get();
                $nbBet = $game->tournament->participants/2;
                $firstMatch = $matches->sortBy('date')->first();
                $mail_status = false;
                foreach ($users as $user){
                    $u = User::find($user->user_id);
                    $userBets = Bet::where('user_id', $u->id)->where('game_id', $game->id)->whereIn('match_id', $matchesID)->count();
                    echo "user $user";
                    if($userBets < $nbBet){
                        echo "missing bets";
                        if($firstMatch->date->copy()->addDays('1')->lt(now()) && !$game->mail_status){
                            echo "date : $firstMatch->date->copy()->addDays('1')";
                            //send mail to complete bets
                            $mail_status = true;
                            if($user->send_mail){
                                Mail::to($u->user)->send(new betAlert($game,$u));
                            }
                        }
                    }
                }
                if($mail_status){
                    $game->mail_status = true;
                    $game->save();
                }
            }
        }
    }
}
