<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(KaryawanSeeder::class);
        User::create([
            'name' => 'Niken Diah',
            'username' => 'username',
            'role_id' => 1,
            'password' => bcrypt('password'),
        ]);
    }
}
