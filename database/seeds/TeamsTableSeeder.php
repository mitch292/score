<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'name' => 'Athletics',
            'external_id' => '133',
            'city' => 'Oakland',
            'state' => 'CA',
            'ballpark_name' => 'Oakland Coliseum',
            'path_to_logo' => '/assests/images/teams/atheltics.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Pirates',
            'external_id' => '134',
            'city' => 'Pittsburgh',
            'state' => 'PA',
            'ballpark_name' => 'PNC Park',
            'path_to_logo' => '/assests/images/teams/pirates.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Padres',
            'external_id' => '135',
            'city' => 'San Diego',
            'state' => 'CA',
            'ballpark_name' => 'Petco Park',
            'path_to_logo' => '/assests/images/teams/padres.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Mariners',
            'external_id' => '136',
            'city' => 'Seattle',
            'state' => 'WA',
            'ballpark_name' => 'T-Mobile Park',
            'path_to_logo' => '/assests/images/teams/mariners.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Giants',
            'external_id' => '137',
            'city' => 'San Francisco',
            'state' => 'CA',
            'ballpark_name' => 'Oracle Park',
            'path_to_logo' => '/assests/images/teams/giants.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Cardinals',
            'external_id' => '138',
            'city' => 'St. Louis',
            'state' => 'MO',
            'ballpark_name' => 'Busch Stadium',
            'path_to_logo' => '/assests/images/teams/cardinals.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Rays',
            'external_id' => '139',
            'city' => 'Tampa Bay',
            'state' => 'FL',
            'ballpark_name' => 'Tropicana Field',
            'path_to_logo' => '/assests/images/teams/rays.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Rangers',
            'external_id' => '140',
            'city' => 'Texas',
            'state' => 'TX',
            'ballpark_name' => 'Globe Life Park in Arlington',
            'path_to_logo' => '/assests/images/teams/rangers.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Blue Jays',
            'external_id' => '141',
            'city' => 'Toronto',
            'state' => 'ON',
            'ballpark_name' => 'Rogers Centre',
            'path_to_logo' => '/assests/images/teams/bluejays.png',
        ]);

    }
}
