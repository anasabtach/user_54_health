<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{   
    public function __construct(){
        $this->middleware('verified_payment');
        $this->__viewData['header_class'] = '';
        $this->__viewData['body_class'] = '';
        $this->__viewData['is_show_footer'] = true;
        $this->__viewData['footer_class'] = 'mt';
    }

    public function showForm(){
        $this->__viewData['footer_class'] = 'mt';

        return $this->__renderView('payment.index');
    }

    public function getPayment(Request $request){
       
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Bearer ' . config('services.stripe.stripe_secret_key'),
        ])->post('https://api.stripe.com/v1/charges', [
            'amount' => 100 * 100,
            'currency' => config('services.stripe.stripe_charge_currency'),
            'source' => $request->input('stripeToken'), // Stripe token
        ]);

        if($response->successful()){
            $user = auth()->user();
            $user->is_paid = 1;
            $user->paid_at = now();
            $user->save();

            return redirect()->route('welcome');
        }
        return redirect()->back()->with('error', 'Some error occured please try again');
    }
}
