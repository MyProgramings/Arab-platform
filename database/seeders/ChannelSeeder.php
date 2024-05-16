<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = User::create([
            'name' => "hsoub-academy",
            'user_name' => "Ahmed Salem",
            'email' => 'academy-hsoub@gmail.com',
            'level' => 0,
            'password' => bcrypt('11111111'),
            'administration_level' => '2',
            'current_team_id' => '1',
        ]);

        $channel2 = User::create([
            'name' => "hsoub",
            'user_name' => "Ahmed Salem",
            'email' => 'hsoub@gmail.com',
            'level' => 0,
            'password' => bcrypt('11111111'),
            'administration_level' => '0',
            'current_team_id' => '2',
        ]);

        $channel3 = User::create([
            'name' => "Mostaql",
            'user_name' => "Ahmed Salem",
            'email' => 'Mostaql@gmail.com',
            'level' => 0,
            'password' => bcrypt('11111111'),
            'administration_level' => '0',
            'current_team_id' => '3',
        ]);

        $channel4 = User::create([
            'name' => "Baeed",
            'user_name' => "Ahmed Salem",
            'email' => 'Baeed@gmail.com',
            'level' => 0,
            'password' => bcrypt('11111111'),
            'administration_level' => '0',
            'current_team_id' => '4',
        ]);

        $channel5 = User::create([
            'name' => "Khamsat",
            'user_name' => "Ahmed Salem",
            'email' => 'Khamsat@gmail.com',
            'level' => 0,
            'password' => bcrypt('11111111'),
            'administration_level' => '0',
            'current_team_id' => '5',
        ]);

        $channel6 = User::create([
            'name' => "Ana",
            'user_name' => "Ahmed Salem",
            'email' => 'Ana@gmail.com',
            'level' => 0,
            'password' => bcrypt('11111111'),
            'administration_level' => '0',
            'current_team_id' => '6',
        ]);
    }
}
