<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Rabbit;
use App\Models\Breeding;
use Illuminate\Database\Eloquent\Factories\Factory;

class BreedingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Breeding::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'org_id'               => 1,
            'litter_no'            => null,
            'cage_no'              => $this->faker->numberBetween(1, 100),
            'parent_doe'           => Rabbit::query()->where('gender', 'doe')->inRandomOrder()->first()->id,
            'parent_buck'          => Rabbit::query()->where('gender', 'buck')->inRandomOrder()->first()->id,
            'date_bred'            => $this->faker->dateTimeBetween('-1 year', 'now'),
            'expected_kindle_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'kindle_date'          => $this->faker->dateTimeBetween('-1 year', 'now'),
            'weaning_date'         => $this->faker->dateTimeBetween('-1 year', 'now'),
            'planned_rebreed_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'isRebreed'            => $this->faker->randomElement([1, 0]),
            'born_alive'           => 10,
            'born_dead'            => 0,
            'total_kits'           => 10,
            'born_doe'             => 5,
            'born_buck'            => 5,
            'notes'                => 'Seeder',
            'inserted_by'          => User::inRandomOrder()->first()->name,
        ];
    }
}
