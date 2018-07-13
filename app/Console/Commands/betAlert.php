<?php

namespace App\Console\Commands;

use App\Jobs\betAlertMail;
use Illuminate\Console\Command;

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
        betAlertMail::dispatch();
        $this->info("Mail job done ...");
    }
}
