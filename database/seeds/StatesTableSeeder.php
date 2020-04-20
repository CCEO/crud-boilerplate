<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            'id'                => '1',
            'name'              => 'Aguascalientes',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '2',
            'name'              => 'Baja California',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '3',
            'name'              => 'Baja California Sur',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '4',
            'name'              => 'Campeche',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '5',
            'name'              => 'Chiapas',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '6',
            'name'              => 'Chihuahua',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '7',
            'name'              => 'Ciudad de México',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '8',
            'name'              => 'Coahuila de Zaragoza',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '9',
            'name'              => 'Colima',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '10',
            'name'              => 'Durango',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '11',
            'name'              => 'Guanajuato',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '12',
            'name'              => 'Guerrero',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '13',
            'name'              => 'Hidalgo',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '14',
            'name'              => 'Jalisco',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '15',
            'name'              => 'México',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '16',
            'name'              => 'Michoacán de Ocampo',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '17',
            'name'              => 'Morelos',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '18',
            'name'              => 'Nayarit',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '19',
            'name'              => 'Nuevo León',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '20',
            'name'              => 'Oaxaca',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '21',
            'name'              => 'Puebla',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '22',
            'name'              => 'Querétaro',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '23',
            'name'              => 'Quintana Roo',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '24',
            'name'              => 'San Luis Potosí',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '25',
            'name'              => 'Sinaloa',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '26',
            'name'              => 'Sonora',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '27',
            'name'              => 'Tabasco',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '28',
            'name'              => 'Tamaulipas',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '29',
            'name'              => 'Tlaxcala',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '30',
            'name'              => 'Veracruz de Ignacio de la Llave',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '31',
            'name'              => 'Yucatán',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('states')->insert([
            'id'                => '32',
            'name'              => 'Zacatecas',
            'country_id'        => '1',
            'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
