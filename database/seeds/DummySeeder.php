<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create("id_ID");

        $reflections = [];
        for ($i = 0; $i < 50; $i++) {
            $reflections[] = [
                'date' => $faker->date('Y-m-d'),
                'cms_users_id' => $faker->randomElement([2, 3]),
                'title' => $faker->sentence(),
                'content' => $faker->paragraph(),
            ];
        }

        DB::table('reflections')->insert($reflections);

        $worships = [];
        for ($i = 0; $i < 50; $i++) {
            $worships[] = [
                'datetime' => $faker->dateTime(),
                'poster' => $faker->imageUrl(),
                'speaker' => $faker->name(),
                'title' => $faker->sentence(),
                'description' => $faker->paragraph(),
                'media' => $faker->randomElement(['Zoom', 'Google Meet', 'Microsoft Teams']),
                'link' => $faker->url(),
            ];
        }

        DB::table('worships')->insert($worships);
    }
}
