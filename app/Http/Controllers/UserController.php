<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the specified user's public profile.
     */
    public function show(User $user)
    {
        $posts = $user->posts()
            ->with(['category'])
            ->published()
            ->latest('published_at')
            ->paginate(10);

        $isFollowing = auth()->check() && auth()->user()->isFollowing($user);

        return view('users.show', compact('user', 'posts', 'isFollowing'));
    }

    /**
     * Follow a user.
     */
    public function follow(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot follow yourself.');
        }

        if (!auth()->user()->isFollowing($user)) {
            auth()->user()->following()->attach($user->id);
        }

        return back();
    }

    /**
     * Unfollow a user.
     */
    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user->id);

        return back();
    }
}

