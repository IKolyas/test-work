<?php

use Illuminate\Database\Seeder;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Ad::class, 20)->create()->each(function ($ad) {
            $ad->adImages()->save(factory(App\AdImage::class)->make());
        });
    }
}
