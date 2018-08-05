<?php

namespace App\Console\Commands;

use App\Bet;
use App\Game;
use App\Mail\mailBetAlert;
use App\Match;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class betAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bet:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail reminder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Launch Mail Job
        $this->info("Starting mail job ...");
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
                    $this->info($user->user->pseudo);
                    if($userBets < $nbBet){
                        $this->info("missing bets ");
                        if($firstMatch->date->copy()->addDays('1')->lt(now()) && !$game->mail_status){
                            $this->info("date :".$firstMatch->date->copy()->addDays('1'));
                            //send mail to complete bets
                            $mail_status = true;
                            if($user->user->send_mail){
                                $this->info("send mail to". $user->user->email);
                                Mail::to($user->user->email)->send(new mailBetAlert($game,$user->user));
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
        $this->info("Mail job done ...");
    }
}
