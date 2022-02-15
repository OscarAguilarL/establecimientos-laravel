<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'nombre' => 'Restaurantes',
            'slug' => Str::slug('Restaurantes'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Cafés',
            'slug' => Str::slug('Cafés'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Hoteles',
            'slug' => Str::slug('Hoteles'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Bares',
            'slug' => Str::slug('Bares'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Hospitales',
            'slug' => Str::slug('Hospitales'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Gimnasios',
            'slug' => Str::slug('Gimnasios'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Doctor',
            'slug' => Str::slug('Doctor'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
