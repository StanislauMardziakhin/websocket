<?php

namespace App\Http\Controllers;

use App\Events\SendReactionEvent;
use App\Http\Requests\User\SendReactionRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return inertia('User/Profile', compact('user'));
    }

    public function sendReaction(User $user, SendReactionRequest $request)
    {
        $data = $request->validated();
        $reactionStr = 'You received a reaction from user ' . $data['from_user'];

        broadcast(new SendReactionEvent($reactionStr, $user->id))->toOthers();

        return response()->json([
            'reaction_str' => $reactionStr
        ]);
    }
}
