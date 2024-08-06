<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\UserState;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserState>
 */
class UserStateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // User 모델의 팩토리로 사용자 ID를 생성합니다.
            'active' => true,
        ];
    }
}
