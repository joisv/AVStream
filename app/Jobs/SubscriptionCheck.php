<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SubscriptionCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
       
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $subscriptions = Subscription::where('status', 'active')->get();

        foreach ($subscriptions as $subscription) {
            if (now()->isAfter($subscription->end_date)) {
                Log::info('Subscription expired: ' . $subscription->id);
                $subscription->update(['status' => 'expired']);
                Notification::create([
                    'user_id' => $subscription->user_id,
                    'title' => 'VIP subscription expired',
                    'message' => 'Your VIP subscription has expired, and access to premium content has been deactivated. Renew now to continue enjoying the best! 🌟📚📺',
                    'is_read' => true
                ]);
                $subscription->user->removeRole('vip');
            }
        }
    }
}
