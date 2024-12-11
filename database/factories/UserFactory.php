<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => 'Super Admin',

            'username' => 'admin',

            'email' => 'admin@example.com',

            'bio' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos dicta debitis similique obcaecati, magni porro! Dolorem vel nobis modi, repudiandae nisi, libero quis animi molestiae numquam possimus temporibus delectus blanditiis est nostrum nesciunt iure.',

            'profile_picture' => 'profile_images/default-avatar.png',
            
            'email_verified_at' => now(),

            'password' => static::$password ??= Hash::make('password'),

            'remember_token' => Str::random(10),
            
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
