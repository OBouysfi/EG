<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            ['name' => 'CASABLANCA'],
            ['name' => 'AGADIR'],
            ['name' => 'BENOUSS'],
            ['name' => 'BERRECHID'],
            ['name' => 'FES'],
            ['name' => 'KENITRA'],
            ['name' => 'MEKNES'],
            ['name' => 'MOHAMADIA'],
            ['name' => 'NADOR'],
            ['name' => 'OUJDA'],
            ['name' => 'SALE'],
            ['name' => 'SETTAT'],
            ['name' => 'TANGER'],
            ['name' => 'TAZA'],
        ];

        DB::table('regions')->insert($regions);
    }
}
