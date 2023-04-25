<?php

namespace App\Http\Controllers;

use App\Events\PublishMessageEvent;
use App\Http\Requests\Messenger\PublishRequest;
use App\Http\Resources\Messenger\MessageResource;
use App\Models\Messenger;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Messenger::latest()->get();
        $messages = MessageResource::collection($messages)->resolve();
        return inertia('Messenger/Index', compact('messages'));
    }

    public function publish(PublishRequest $request){
        $data = $request->validated();
        $message = Messenger::create($data);
        event(new PublishMessageEvent($message));
        return MessageResource::make($message)->resolve();
    }

}
