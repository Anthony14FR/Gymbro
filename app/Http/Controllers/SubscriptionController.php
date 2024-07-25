<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Subscription;
use Stripe\Subscription as StripeSubscription;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('premium')) {
            return redirect()->route('home')->with('error', 'You are already subscribed to our service.');
        }
        return view('subscriptions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $plan = $request->input('billing') == 'yearly' ? 'price_1PZexeRtMOHHqwJgAqqOnDSG' : 'price_1PZf03RtMOHHqwJgN9niNnVB';

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price' => $plan,
                    'quantity' => 1,
                ]
            ],
            'mode' => 'subscription',
            'success_url' => route('subscriptions.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('subscriptions.cancel'),
        ]);

        return redirect($session->url, 303);
    }

    public function success(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session_id = $request->input('session_id');

        if (!$session_id) {
            return redirect()->route('subscriptions.index')->with('error', 'Session ID manquant. Veuillez réessayer.');
        }

        $session = Session::retrieve($session_id);

        if ($session->payment_status === 'paid') {
            $subscription = StripeSubscription::retrieve($session->subscription);
            $plan_id = $subscription->items->data[0]->plan->id;
            $user = auth()->user();
            Subscription::create([
                'user_id' => $user->id,
                'stripe_id' => $session->customer,
                'stripe_subscription_id' => $session->subscription,
                'stripe_plan' => $plan_id,
                'ends_at' => Carbon::createFromTimestamp($session->expires_at)->addMonth(),
                'isCancelled' => false,
            ]);
            $user->assignRole('premium');
            $user->update(['role' => 'premium']);

            return redirect()->route('home')->with('success', 'Vous êtes maintenant abonné à notre service, merci et bienvenue !');
        } else {
            return redirect()->route('subscriptions.index')->with('error', 'Il semble qu\'il y ait eu un problème avec votre paiement. Veuillez réessayer.');
        }
    }

    public function cancel()
    {
        return redirect()->route('subscriptions.index')->with('error', 'Il semble qu\'il y ait eu un problème avec votre paiement. Veuillez réessayer.');
    }

    public function unsubscribe(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $user = auth()->user();
        $subscription = $user->subscription;

        if (!$subscription) {
            return redirect()->route('profile.edit')->with('error', 'Aucun abonnement actif trouvé.');
        }

        try {
            $stripeSubscription = StripeSubscription::retrieve($subscription->stripe_subscription_id);

            if ($stripeSubscription->status === 'canceled') {
                return redirect()->route('profile.edit')->with('error', 'L\'abonnement est déjà annulé.');
            }

            $stripeSubscription->cancel_at_period_end = true;
            $stripeSubscription->save();

            $subscription->update([
                'ends_at' => Carbon::createFromTimestamp($stripeSubscription->current_period_end),
                'isCancelled' => true,
            ]);

            return redirect()->route('profile.edit')->with('success', 'Votre abonnement sera annulé à la fin de la période de facturation en cours.');
        } catch (\Exception $e) {
            return redirect()->route('profile.edit')->with('error', 'Erreur lors de l\'annulation de votre abonnement : ' . $e->getMessage());
        }
    }
}
