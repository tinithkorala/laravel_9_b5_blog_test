<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create(['name' => 'Test', 'email' => 'test@test.com', 'password' => '$2y$10$e0U9PEGA0I58NrjqVAnGd.iC58p2DtuRILmaM7FTWLO68NsUIvlBi', 'is_admin' => true]);
    }
}
