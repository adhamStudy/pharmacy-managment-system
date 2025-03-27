<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class Expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expire users every 5 minutes automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users=User::where('name','!=','adhm waleed')->get();

        foreach($users as $user){
            $user->update(['role'=>0]);
        }
        Log::info('app:expiration command finished.');
    }
}
