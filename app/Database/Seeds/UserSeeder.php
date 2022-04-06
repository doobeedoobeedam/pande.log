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
            $nik = 3276030;
            $numberFaker = $faker->randomNumber(9, true);
            $data = [
                'number'        => $nik.$numberFaker,
                'fullname'      => $faker->name,
                'password'      => password_hash('password', PASSWORD_DEFAULT),
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
