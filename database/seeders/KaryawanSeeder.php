<?php

namespace Database\Seeders;

use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 1; $i < 10; $i++) {
            $idHanyar = Karyawan::create([
                'nm_karyawan' => $faker->firstName,
                'tgl_masuk' => $faker->date,
                'alamat' => $faker->address,
                'tgl_masuk' => $faker->date,
                'posisi' => $faker->jobTitle,
            ]);

            $idKaryawan = $idHanyar->id;
            Gaji::create([
                'id_karyawan' => $idKaryawan,
                'rp_gaji' => 100000,
            ]);

            User::create([
                'name' => $faker->firstName,
                'username' => strtolower($faker->firstName),
                'role_id' => 3,
                'password' => bcrypt(strtolower($faker->firstName)),
            ]);
        }
    }
}
