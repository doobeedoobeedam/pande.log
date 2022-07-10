<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class LogSeeder extends Seeder
{
    public function run() {
        // $data = [
        //     'user_id' => 1,
        //     'date'    => '07/03/2022',
        //     'time'    => '11:43',
        //     'location'    => 'Tokyo',
        //     'temperature'    => '34',
        // ];
        

        $faker = \Faker\Factory::create();
        for($i = 0; $i < 30; $i++) {
            $data = [
                'user_id'       => $faker->randomDigitNotNull(),
                // 'date'          => '2022-'.$faker->date('m-d'),
                'date'          => '2022-04-'.$faker->date('d'),
                'time'          => $faker->time(),
                'location'      => $faker->country(),
                'temperature'   => $faker->randomFloat(1, 30, 40),
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ];

            // Using Query Builder
            $this->db->table('logs')->insert($data);
        }
    }
}
