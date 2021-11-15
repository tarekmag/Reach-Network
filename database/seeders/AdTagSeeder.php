<?php

namespace Database\Seeders;

use App\Models\AdTag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        AdTag::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        AdTag::factory()->count(200)->create();
    }
}
