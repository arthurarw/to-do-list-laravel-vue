<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'firstname' => 'Admin',
            'email' => 'arthur@mail.com',
            'password' => bcrypt('123456')
        ]);

        User::factory()->count(5)->create();
    }
}
