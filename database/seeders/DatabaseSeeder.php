<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $users = [
            [
                "name" => "Ronak Prajapati",
                "email" => "ronak.prajapati@atozinfoway.com",
                "password" => bcrypt("123456"),
                "birthdate" => "1996-11-10"
            ],
            [
                "name" => "Bhagyesh",
                "email" => "bhagyesh.gambhva@atozinfoway.com",
                "password" => bcrypt("123456"),
                "birthdate" => "1996-07-04"
            ],
            [
                "name" => "Nirmal",
                "email" => "prajapatironi1011@gmail.com",
                "password" => bcrypt("123456"),
                "birthdate" => "1996-06-09"
            ]
        ];

        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
