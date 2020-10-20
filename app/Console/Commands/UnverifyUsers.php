<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UnverifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:unverify {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unverify user by ID';

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
     * @return int
     */
    public function handle()
    {
        $user_id = $this->argument('user_id');
        if($user = User::find($user_id)){
            if($user->email_verified_at){
                $user->email_verified_at = null;
                $user->save();
                $this->info( "User with " . $user->id . " ID is unverified.");
            } else {
                $this->info("User already is unverified.");
            }
        } else {
            $this->info("User not found.");
        }
    }
}
