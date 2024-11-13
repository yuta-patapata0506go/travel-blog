<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;
    public function definition(): array
    {
        return [
            //
            'spot_id' => 1, // テスト用の spot_id を指定
            'user_id' => \App\Models\User::factory(),  // 既存のユーザーからuser_idを取得
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'views' => $this->faker->numberBetween(0, 100),
            'likes' => $this->faker->numberBetween(0, 50),
            // 必要な他のカラムも追加してください
        ];
    }
}
