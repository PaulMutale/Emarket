<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FlutterwaveWebhookResponse extends Controller
{
    //
    // Webhook url callback response
    public function flutterwave_callback_response(Request $request)
    {
        // Verying hash secret_hash, checking for the signature
        $secretHash = config('flutterwave.secret_hash');
        $signature = $request->header('verif-hash');
        if (!$signature || ($signature !== $secretHash)) {
            // This request isn't from Flutterwave; discard
            abort(401);
        }

        // Verying Successfull transaction
        if ($request->event == 'charge.completed' && $request->data->status == 'successful') {
        

        //Perfoming something Long now
        $amount = $request->data->amount; // Here ZMW 1 is equal to 1 unit
        $user_email = $request->data->customer['email']; //Here is the email address of the customer
        $identify_payer = User::where('email', "=", $user_email)->firstOrFail();
        $identify_payer->wallet->deposit($amount, ["description" => "Purchase of ZMW $amount units from Flutterwave"]);
        $identify_payer->save();
        }
       
        //Return successfull response to acknowledge receipt of a webhook
        return response(200);
    }
}
