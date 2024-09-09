<?php

namespace App\Http\Controllers;

use App\Actions\Subscription\StoreAction\StoreAction;
use App\Constants\StatusEnum;
use App\Constants\TypeSubscriptionEnum;
use App\Models\Site;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(StoreAction $storeAction, Request $resquest)
    {
        $dataAction = $storeAction->execute($resquest);
        $data = $dataAction['data'];
        $subscription = $dataAction['subscription'];
        $response = Http::post(config('subscription.placetopay')['url'], $data);
        $result = $response->json();
        $subscription->update([
           'request_id' => $result['requestId'],
            'process_url' => $result['processUrl'],
            'status_message' => $result['status']['message'],

        ]);
        if($response->ok()) {
            return Inertia::location($result['processUrl']);
        }
        return redirect()->route('subscription.show', $site->slug)->withErrors(['subscription' => $result['status']['message']]);
    }

    public function return(Subscription $subscription)
    {
        return Inertia::render('Subscription/Return', [
            'subscription' => $subscription
        ]);

    }

    public function show(Subscription $subscription)
    {
        //
    }

    public function edit(Subscription $subscription)
    {
        //
    }

    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    public function destroy(Subscription $subscription)
    {

    }
}
