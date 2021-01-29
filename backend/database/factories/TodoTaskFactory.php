<?php

namespace Database\Factories;

use App\Models\TodoTask;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoTaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TodoTask::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label' => $this->faker->sentence,
            'is_complete' => $this->faker->boolean
        ];
    }
}
