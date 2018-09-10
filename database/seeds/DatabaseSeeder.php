<?php

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
        $faker = Faker\Factory::create();
        DB::table('users')->insert([
            'name'       => 'test',
            'email'      => 'test@test.tdl',
            'password'   => bcrypt('test'),
            'created_at' => $faker->dateTime()
        ]);

        DB::table('user_info')->insert([
            'user_id'    => 1,
            'firstname'  => str_random(10),
            'lastname'   => str_random(10),
            'secondname' => str_random(10),
            'phone'      => '123456789',
            'created_at' => $faker->dateTime()
        ]);

        for ($i = 0; $i < 500; $i++) {
            DB::table('ads')->insert([
                'user_id'    => 1,
                'title'      => $faker->realText(15),
                'body'       => $faker->realText(200),
                'created_at' => $faker->dateTimeBetween('-1 years', 'now')
            ]);
        }

    }
}
