<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use Stripe\Stripe;
use Stripe\Subscription as StripeSubscription;

class CheckSubscriptions extends Command
{
    protected $signature = 'subscriptions:check';
    protected $description = 'Check the status of all subscriptions';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $this->info('Fetching all subscriptions from the database...');

        $subscriptions = Subscription::all();

        if ($subscriptions->isEmpty()) {
            $this->info('No subscriptions found.');
            return;
        }

        $this->info('Found ' . $subscriptions->count() . ' subscriptions.');

        foreach ($subscriptions as $subscription) {
            $this->info('Checking subscription: ' . $subscription->stripe_subscription_id);

            try {
                // Retrieve subscription with only the necessary fields
                $stripeSubscription = StripeSubscription::retrieve(
                    $subscription->stripe_subscription_id,
                    ['expand' => ['items.data.plan']]
                );

                $status = $stripeSubscription->status;
                $this->info('Subscription status for ' . $subscription->stripe_subscription_id . ': ' . $status);

                if ($status != 'active') {
                    if (is_null($subscription->ends_at)) {
                        $subscription->ends_at = now();
                        $subscription->save();

                        $this->info('Subscription ' . $subscription->stripe_subscription_id . ' has been marked as ended.');
                    } else {
                        $this->info('Subscription ' . $subscription->stripe_subscription_id . ' was already marked as ended.');
                    }
                } else {
                    $this->info('Subscription ' . $subscription->stripe_subscription_id . ' is still active.');
                }
            } catch (\Exception $e) {
                $this->error('Error checking subscription ' . $subscription->stripe_subscription_id . ': ' . $e->getMessage());
            }
        }

        $this->info('All subscriptions have been checked.');
    }
}
