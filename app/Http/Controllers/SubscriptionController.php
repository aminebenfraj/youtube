<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function create($subscribedtoid){
        if(auth()->user()->id != $subscribedtoid){

            $existingSubscription = Subscription::where('subscriberid', auth()->user()->id)->where('subscribedtoid', $subscribedtoid)->first();
            if($existingSubscription == null){
                Subscription::create([
                    'subscriberid' => auth()->user()->id,
                    'subscribedtoid' => $subscribedtoid
                ]);
            } else {
                $existingSubscription->delete();
            }
        }
        
        return redirect()->back();

    }
}
