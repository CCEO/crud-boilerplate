<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContinentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('continents')->insert([
            'id'                => '1',
            'name'              => 'Asia',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('continents')->insert([
            'id'                => '2',
            'name'              => 'América',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('continents')->insert([
            'id'                => '3',
            'name'              => 'África',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('continents')->insert([
            'id'                => '4',
            'name'              => 'Antártida',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('continents')->insert([
            'id'                => '5',
            'name'              => 'Europa',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('continents')->insert([
            'id'                => '6',
            'name'              => 'Oceanía',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
