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
            'prefix' => 'Oakland',
            'state' => 'CA',
            'ballpark_name' => 'Oakland Coliseum',
            'path_to_logo' => '/assets/images/teams/athletics.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Pirates',
            'external_id' => '134',
            'prefix' => 'Pittsburgh',
            'state' => 'PA',
            'ballpark_name' => 'PNC Park',
            'path_to_logo' => '/assets/images/teams/pirates.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Padres',
            'external_id' => '135',
            'prefix' => 'San Diego',
            'state' => 'CA',
            'ballpark_name' => 'Petco Park',
            'path_to_logo' => '/assets/images/teams/padres.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Mariners',
            'external_id' => '136',
            'prefix' => 'Seattle',
            'state' => 'WA',
            'ballpark_name' => 'T-Mobile Park',
            'path_to_logo' => '/assets/images/teams/mariners.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Giants',
            'external_id' => '137',
            'prefix' => 'San Francisco',
            'state' => 'CA',
            'ballpark_name' => 'Oracle Park',
            'path_to_logo' => '/assets/images/teams/giants.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Cardinals',
            'external_id' => '138',
            'prefix' => 'St. Louis',
            'state' => 'MO',
            'ballpark_name' => 'Busch Stadium',
            'path_to_logo' => '/assets/images/teams/cardinals.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Rays',
            'external_id' => '139',
            'prefix' => 'Tampa Bay',
            'state' => 'FL',
            'ballpark_name' => 'Tropicana Field',
            'path_to_logo' => '/assets/images/teams/rays.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Rangers',
            'external_id' => '140',
            'prefix' => 'Texas',
            'state' => 'TX',
            'ballpark_name' => 'Globe Life Park in Arlington',
            'path_to_logo' => '/assets/images/teams/rangers.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Blue Jays',
            'external_id' => '141',
            'prefix' => 'Toronto',
            'state' => 'ON',
            'ballpark_name' => 'Rogers Centre',
            'path_to_logo' => '/assets/images/teams/bluejays.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Twins',
            'external_id' => '142',
            'prefix' => 'Minnesota',
            'state' => 'MN',
            'ballpark_name' => 'Target Field',
            'path_to_logo' => '/assets/images/teams/twins.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Phillies',
            'external_id' => '143',
            'prefix' => 'Philadelphia',
            'state' => 'PA',
            'ballpark_name' => 'Citizens Bank Park',
            'path_to_logo' => '/assets/images/teams/phillies.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Braves',
            'external_id' => '144',
            'prefix' => 'Atlanta',
            'state' => 'GA',
            'ballpark_name' => 'SunTrust Park',
            'path_to_logo' => '/assets/images/teams/braves.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'White Sox',
            'external_id' => '145',
            'prefix' => 'Chicago',
            'state' => 'IL',
            'ballpark_name' => 'Guaranteed Rate Field',
            'path_to_logo' => '/assets/images/teams/whitesox.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Marlins',
            'external_id' => '146',
            'prefix' => 'Miami',
            'state' => 'FL',
            'ballpark_name' => 'Marlins Park',
            'path_to_logo' => '/assets/images/teams/marlins.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Yankees',
            'external_id' => '147',
            'prefix' => 'New York',
            'state' => 'NY',
            'ballpark_name' => 'Yankee Stadium',
            'path_to_logo' => '/assets/images/teams/yankees.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Brewers',
            'external_id' => '158',
            'prefix' => 'Milwaukee',
            'state' => 'WI',
            'ballpark_name' => 'Miller Park',
            'path_to_logo' => '/assets/images/teams/brewers.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Angels',
            'external_id' => '108',
            'prefix' => 'Los Angeles',
            'state' => 'CA',
            'ballpark_name' => 'Angel Stadium',
            'path_to_logo' => '/assets/images/teams/angels.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Diamonbacks',
            'external_id' => '109',
            'prefix' => 'Arizona',
            'state' => 'AZ',
            'ballpark_name' => 'Chase Field',
            'path_to_logo' => '/assets/images/teams/diamondbacks.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Orioles',
            'external_id' => '110',
            'prefix' => 'Baltimore',
            'state' => 'MD',
            'ballpark_name' => 'Oriole Park at Camden Yards',
            'path_to_logo' => '/assets/images/teams/orioles.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Red Sox',
            'external_id' => '111',
            'prefix' => 'Boston',
            'state' => 'MA',
            'ballpark_name' => 'Fenway Park',
            'path_to_logo' => '/assets/images/teams/redsox.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Cubs',
            'external_id' => '112',
            'prefix' => 'Chicago',
            'state' => 'IL',
            'ballpark_name' => 'Wrigley Field',
            'path_to_logo' => '/assets/images/teams/cubs.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Reds',
            'external_id' => '113',
            'prefix' => 'Cincinnati',
            'state' => 'OH',
            'ballpark_name' => 'Great American Ball Park',
            'path_to_logo' => '/assets/images/teams/reds.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Indians',
            'external_id' => '114',
            'prefix' => 'Cleveland',
            'state' => 'OH',
            'ballpark_name' => 'Progressive Field',
            'path_to_logo' => '/assets/images/teams/indians.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Rockies',
            'external_id' => '115',
            'prefix' => 'Colorado',
            'state' => 'CO',
            'ballpark_name' => 'Coors Field',
            'path_to_logo' => '/assets/images/teams/rockies.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Tigers',
            'external_id' => '116',
            'prefix' => 'Detroit',
            'state' => 'MI',
            'ballpark_name' => 'Comerica Park',
            'path_to_logo' => '/assets/images/teams/tigers.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Astros',
            'external_id' => '117',
            'prefix' => 'Houston',
            'state' => 'TX',
            'ballpark_name' => 'Minute Maid Park',
            'path_to_logo' => '/assets/images/teams/astros.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Royals',
            'external_id' => '118',
            'prefix' => 'Kansas City',
            'state' => 'MO',
            'ballpark_name' => 'Kauffman Stadium',
            'path_to_logo' => '/assets/images/teams/royals.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Dodgers',
            'external_id' => '119',
            'prefix' => 'Los Angeles',
            'state' => 'CA',
            'ballpark_name' => 'Dodger Stadium',
            'path_to_logo' => '/assets/images/teams/dodgers.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Nationals',
            'external_id' => '120',
            'prefix' => 'Washington',
            'state' => 'DC',
            'ballpark_name' => 'Nationals Park',
            'path_to_logo' => '/assets/images/teams/nationals.png',
        ]);

        DB::table('teams')->insert([
            'name' => 'Mets',
            'external_id' => '121',
            'prefix' => 'New York',
            'state' => 'NY',
            'ballpark_name' => 'Citi Field',
            'path_to_logo' => '/assets/images/teams/mets.png',
        ]);

    }
}
