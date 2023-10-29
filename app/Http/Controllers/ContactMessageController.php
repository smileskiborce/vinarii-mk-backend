<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMessageRequest;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactMessageController extends Controller
{
    public function store(ContactMessageRequest $request): JsonResource
    {
        $contactMessage = new ContactMessage($request->validated());
        if ($request->get('user_id')) {
            $user = User::query()->firstWhere('id', $request->get('user_id'));
            $contactMessage->user()->associate($user);
        }
        $contactMessage->save();

        return JsonResource::make($contactMessage);
    }
}
