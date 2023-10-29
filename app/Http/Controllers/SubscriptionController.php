<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionController extends Controller
{
    public function store(SubscriptionRequest $request): JsonResource
    {
        $subscription = Subscription::query()
            ->create($request->validated());

        return JsonResource::make($subscription);
    }
}
