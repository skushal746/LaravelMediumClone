<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Follow;
use App\Models\Like;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create categories
        $categories = Category::factory(5)->create();

        // Create users
        $users = User::factory(10)->create();

        // Create posts for each user
        foreach ($users as $user) {
            Post::factory(rand(2, 5))->create([
                'user_id' => $user->id,
                'category_id' => $categories->random()->id,
            ]);
        }

        // Create some follows
        foreach ($users as $user) {
            $following = $users->random(rand(1, 3));
            foreach ($following as $followed) {
                if ($user->id !== $followed->id) {
                    Follow::create([
                        'follower_id' => $user->id,
                        'following_id' => $followed->id,
                    ]);
                }
            }
        }

        // Create some likes
        $posts = Post::all();
        foreach ($users as $user) {
            $likedPosts = $posts->random(rand(5, 15));
            foreach ($likedPosts as $post) {
                Like::create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);
            }
        }
    }
}

