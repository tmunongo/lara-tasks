<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todos>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomNumber = mt_rand(1, 2);

        switch ($randomNumber) {
            case 1:
                $status = 'Done';
                break;
            case 2:
                $status = 'Pending';
                break;
        }

        return [
            //
            'description' => Str::random(10),
            'status' => $status
        ];
    }
}
