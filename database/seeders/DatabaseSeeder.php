<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test8@example.com',
        ]);

        $categoryFirst = Category::factory()->create();
        $categorySecond = Category::factory()->create();
        $categoryThird = Category::factory()->create();

        $userId = $user->id;

        Post::factory(5)
            ->hasAttached($categoryFirst)
            ->has(Comment::factory()->count(15)->state(function (array $attributes) use ($userId) {
                return ['user_id' => $userId];
            }))
            ->for($user)
            ->create();

        Post::factory(3)
            ->hasAttached($categorySecond)
            ->has(Comment::factory()->count(15)->state(function (array $attributes) use ($userId) {
                return ['user_id' => $userId];
            }))
            ->for($user)
            ->create();

        Post::factory(12)
            ->hasAttached($categoryThird)
            ->has(Comment::factory()->count(15)->state(function (array $attributes) use ($userId) {
                return ['user_id' => $userId];
            }))
            ->for($user)
            ->create();
    }
}
