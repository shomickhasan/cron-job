<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Every day update the subscription remaning days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();
        $subscriptionData = Subscription::where('status',1)->get();
        foreach ($subscriptionData as $subscription){
            if($subscription->remaning_day >0){
                $subscription->remaning_day -= 1;
            }
            if(Carbon::parse($subscription->end_date)->toDateString() == $today->format('Y-m-d')){
                $subscription->status = 3;
            }
            $subscription->save();
        }
        $this->info('Subscriptions updated successfully.');
    }
}
