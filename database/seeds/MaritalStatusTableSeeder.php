<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MaritalStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marital_states')->insert([
            'id'                => '1',
            'name'              => 'Soltero',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('marital_states')->insert([
            'id'                => '2',
            'name'              => 'Casado',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('marital_states')->insert([
            'id'                => '3',
            'name'              => 'Divorciado',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('marital_states')->insert([
            'id'                => '4',
            'name'              => 'Unión Libre',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('marital_states')->insert([
            'id'                => '5',
            'name'              => 'Viudo',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
