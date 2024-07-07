<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
            'success_url' => route('subscriptions.success'),
            'cancel_url' => route('subscriptions.cancel'),
        ]);

        return redirect($session->url, 303);
    }

    public function success()
    {
        
        return redirect()->route('home')->with('success', 'Vous êtes maintenant abonné à notre service, merci et bienvenue !');
    }

    public function cancel()
    {
        return redirect()->route('subscriptions.index')->with('error', 'Il semble qu\'il y ait eu un problème avec votre paiement. Veuillez réessayer.');
    }
}
