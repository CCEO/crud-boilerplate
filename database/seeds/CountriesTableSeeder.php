<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            'id'                => '1',
            'name'              => 'México',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '2',
            'name'              => 'Antigua y Barbuda',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '3',
            'name'              => 'Argentina',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '4',
            'name'              => 'Bahamas',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '5',
            'name'              => 'Barbados',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '6',
            'name'              => 'Belice',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '7',
            'name'              => 'Bolivia',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '8',
            'name'              => 'Brasil',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '9',
            'name'              => 'Canadá',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '10',
            'name'              => 'Chile',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '11',
            'name'              => 'Colombia',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '12',
            'name'              => 'Costa Rica',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '13',
            'name'              => 'Cuba',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '14',
            'name'              => 'Dominica',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '15',
            'name'              => 'Ecuador',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '16',
            'name'              => 'El Salvador',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '17',
            'name'              => 'Estados Unidos',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '18',
            'name'              => 'Granada',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '19',
            'name'              => 'Guatemala',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '20',
            'name'              => 'Guyana',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '21',
            'name'              => 'Haití',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '22',
            'name'              => 'Honduras',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '23',
            'name'              => 'Jamaica',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '24',
            'name'              => 'Nicaragua',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '25',
            'name'              => 'Panamá',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '26',
            'name'              => 'Paraguay',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '27',
            'name'              => 'Perú',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '28',
            'name'              => 'República Dominicana',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '29',
            'name'              => 'San Cristóbal y Nieves',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '30',
            'name'              => 'San Vicente y las Granadinas',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '31',
            'name'              => 'Santa Lucía',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '32',
            'name'              => 'Surinam',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '33',
            'name'              => 'Trinidad y Tobago',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '34',
            'name'              => 'Uruguay',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('countries')->insert([
            'id'                => '35',
            'name'              => 'Venezuela',
            'continent_id'      => '2',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
