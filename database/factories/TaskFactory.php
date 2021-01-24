<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(40),
            'description' => $this->faker->text,
            'due_at' => $this->faker->dateTimeBetween('now', '+2 years'),
            'status' => $this->faker->randomElement(['open', 'failed', 'completed']),
            'user_id' => User::all()->random()->id,
        ];
    }
}
