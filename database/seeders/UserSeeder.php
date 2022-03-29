<?php

namespace Database\Seeders;

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
        DB::table('admins')->insert([
            'name' => 'B01',
            'fullname' => 'Bàn 01',
            'role' => 'CUSTOMTER',
            'status' => 1,
            'password' => Hash::make(config('mevivu.default-password')),
        ]);
    }
}
