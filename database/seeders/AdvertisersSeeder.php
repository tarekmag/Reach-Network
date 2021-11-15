<?php

namespace Database\Seeders;

use App\Models\Advertiser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertisersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Advertiser::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Advertiser::factory()->count(50)->create();
    }
}
