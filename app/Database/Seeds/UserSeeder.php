<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
    public function run()
    {
        // with seeder
        // $data = [
            //     'number'    => '07032022',
            //     'fullname'    => 'Kusuma Wecitra',
            //     'role'    => 'general',
            // ];
        
        // with faker
        $faker = \Faker\Factory::create();
        
        for($i = 0; $i < 10; $i++) {
            $data = [
                'number'        => $faker->randomNumber(9, true),
                'fullname'      => $faker->name,
                'role'          => $faker->randomElement(['general', 'admin']),
                'photo'         => 'original.jpg',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ];
            
            // Using Query Builder
            $this->db->table('users')->insert($data);
        }
    }
}
