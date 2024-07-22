<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MailController extends Controller
{
    /**
     * Send mail to users
     */
    public function sendMail(Request $request)
    {
        $request->validate([
            'mail_to.*' => 'required|email',
        ]);

        $mailTos = array_unique($request->mail_to);

        foreach ($mailTos as $mailTo) {
            SendMail::dispatch($mailTo);
        }

        return redirect('/users')->with('success', 'Mails envoyés avec succès');
    }
}
