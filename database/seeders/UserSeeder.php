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
        \App\Models\User::factory()->create([
            'email' => 'andrzej@laczak.com',
            'admin' => 1,
        ]);

        \App\Models\User::factory()->create([
            'email' => 'mariusz@laczak.com',
            'mod' => 1,
        ]);
        \App\Models\User::factory(8)->create();
    }
}
