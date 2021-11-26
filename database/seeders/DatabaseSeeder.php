<?php

namespace Database\Seeders;

use App\Models\Breed;
use App\Models\Breeding;
use App\Models\Category;
use App\Models\Members;
use App\Models\Organization;
use App\Models\Rabbit;
use App\Models\RabbitStatus;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name'              => 'Administrator',
            'email'             => 'admin@site.com',
            'email_verified_at'  => now(),
            'password'          => Hash::make('password'),
            'remember_token'    => Str::random(10),
        ]);

        $organization = Organization::create([
            'name'    => 'Rabbitry',
            'address' => 'local',
            'email'   => 'renier.trenuela@gmail.com',
            'status'  => '1',
        ]);

        Members::create([
            'user_id' => $user->id,
            'org_id'  => $organization->id,
        ]);

        $this->call(PermissionsTableSeeder::class);
        $this->call(ConnectRelationshipsSeeder::class);

        $status = ['breeder', 'kits', 'grow outs', 'sold', 'culled', 'died', 'for sale', 'retired', 'donated',];
        foreach ($status as $value) {
            RabbitStatus::create([
                'name'  => $value,
                'color' => Factory::create()->hexColor,
            ]);
        }

        $breeds = ['amercan', 'angora', 'beige', 'belgian hare', 'californian', 'chinchillia', 'cinnamon'];
        foreach ($breeds as $value) {
            Breed::create([
                'name'  => $value,
            ]);
        }

        $categories = ['local', 'pure', 'f1', 'f2', 'f3', 'hybrid', 'upgraded'];
        foreach ($categories as $value) {
            Category::create([
                'name'  => $value,
            ]);
        }

        Rabbit::factory(20)->create();
        Breeding::factory(20)->create();
    }
}
