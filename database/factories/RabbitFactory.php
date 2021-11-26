<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Models\Breed;
use App\Models\Rabbit;
use App\Models\RabbitStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class RabbitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rabbit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'org_id'      => 1,
            'tag_id'      => null,
            'breeding_id' => null,
            'cage_no'     => $this->faker->numberBetween(1, 100),
            'category_id' => Category::inRandomOrder()->first()->id,
            'breed_id'    => Breed::inRandomOrder()->first()->id,
            'type'        => $this->faker->randomElement(['meat', 'pet']),
            'color'       => $this->faker->colorName(),
            'dob'         => $this->faker->dateTimeBetween('-1 year', 'now'),
            'gender'      => $this->faker->randomElement(['doe', 'buck', 'unknown']),
            'status_id'   => RabbitStatus::inRandomOrder()->first()->id,
            'origin'      => $this->faker->randomElement(['breed', 'purchased', 'unknown']),
            'notes'       => 'Seeder',
            'inserted_by' => User::inRandomOrder()->first()->id,
            'home_breed'  => $this->faker->randomElement(['y', 'n', 'unknown']),
            'updated_by'  => null,
        ];
    }
}
