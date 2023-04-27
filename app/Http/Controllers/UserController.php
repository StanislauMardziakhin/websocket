<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\SendReactionRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return inertia('User/Profile', compact('user'));
    }

    public function sendReaction(SendReactionRequest $request)
    {
        $data = $request->validated();
        $reactionStr = 'You received a reaction from user ' . $data['from_user'];
        return response()->json([
            'reaction_str' => $reactionStr
        ]);
    }
}
