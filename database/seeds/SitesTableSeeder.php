<?php

use App\Site;
use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::truncate();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i ++) {
            DB::table('sites')->insert([
                'name'=>$faker->word,
                'path'=>$faker->url
            ]);
        }
    }
}
