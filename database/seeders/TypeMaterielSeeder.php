<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeMaterielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("type_materiels")->insert([
            ["nom"=> "Scanner"],
            ["nom"=> "Projecteurs"],
            ["nom"=> "Appareils Electroniques"],
            ["nom"=> "Miscroscopes"]
        ]);

       
    }
}
