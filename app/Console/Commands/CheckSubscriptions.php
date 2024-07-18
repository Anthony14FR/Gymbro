<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use App\Models\User;
use Stripe\Stripe;
use Stripe\Subscription as StripeSubscription;
use Carbon\Carbon;

class CheckSubscriptions extends Command
{
    protected $signature = 'subscriptions:check';
    protected $description = 'Check the status of all subscriptions and update accordingly';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $this->info('Fetching all subscriptions from the database...');

        $subscriptions = Subscription::with('user')->get();

        if ($subscriptions->isEmpty()) {
            $this->info('No subscriptions found.');
            return;
        }

        $this->info('Found ' . $subscriptions->count() . ' subscriptions.');

        foreach ($subscriptions as $subscription) {
            $this->info('Checking subscription: ' . $subscription->stripe_subscription_id);

            try {
                $stripeSubscription = StripeSubscription::retrieve(
                    $subscription->stripe_subscription_id,
                    ['expand' => ['items.data.plan']]
                );

                $status = $stripeSubscription->status;
                $this->info('Subscription status for ' . $subscription->stripe_subscription_id . ': ' . $status);

                switch ($status) {
                    case 'active':
                        $this->handleActiveSubscription($subscription, $stripeSubscription);
                        break;
                    case 'canceled':
                    case 'unpaid':
                    case 'incomplete_expired':
                        $this->handleCanceledSubscription($subscription);
                        break;
                    case 'past_due':
                    case 'incomplete':
                        $this->handlePastDueSubscription($subscription, $stripeSubscription);
                        break;
                    default:
                        $this->info('Unhandled subscription status: ' . $status);
                }
            } catch (\Exception $e) {
                $this->error('Error checking subscription ' . $subscription->stripe_subscription_id . ': ' . $e->getMessage());
            }
        }

        $this->info('All subscriptions have been checked.');
    }

    private function handleActiveSubscription($subscription, $stripeSubscription)
    {
        if ($stripeSubscription->cancel_at_period_end) {
            $subscription->ends_at = Carbon::createFromTimestamp($stripeSubscription->current_period_end);
            $subscription->isCancelled = true;
            $this->info('Subscription ' . $subscription->stripe_subscription_id . ' will be canceled at ' . $subscription->ends_at);
        } else {
            $subscription->ends_at = null;
            $subscription->isCancelled = false;
            $this->info('Subscription ' . $subscription->stripe_subscription_id . ' is active and recurring.');
        }

        $subscription->stripe_plan = $stripeSubscription->items->data[0]->plan->id;
        $subscription->save();

        $subscription->user->assignRole('premium');
        $subscription->user->update(['role' => 'premium']);
    }

    private function handleCanceledSubscription($subscription)
    {
        if (!$subscription->isCancelled || (is_null($subscription->ends_at))) {
            $subscription->ends_at = now();
            $subscription->isCancelled = true;
            $subscription->save();
            $this->info('Subscription ' . $subscription->stripe_subscription_id . ' has been marked as ended.');
        } else {
            $this->info('Subscription ' . $subscription->stripe_subscription_id . ' was already marked as ended.');
        }

        $subscription->user->removeRole('premium');
        $subscription->user->update(['role' => 'user']);
    }

    private function handlePastDueSubscription($subscription, $stripeSubscription)
    {
        $grace_period_days = 3;
        $current_period_end = Carbon::createFromTimestamp($stripeSubscription->current_period_end);

        if (now()->diffInDays($current_period_end) > $grace_period_days) {
            $this->handleCanceledSubscription($subscription);
        } else {
            $this->info('Subscription ' . $subscription->stripe_subscription_id . ' is past due but within grace period.');
        }
    }
}