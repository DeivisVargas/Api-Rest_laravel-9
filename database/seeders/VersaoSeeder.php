<?php

namespace Database\Seeders;

use App\Models\Versao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VersaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Versao::create(
            [
                'nome'  => 'Versao seeder 01',
                'abreviacao'    => 'Vr' ,
                'idioma_id'     => 2
            ]
        );

        Versao::create(
            [
                'nome'  => 'Versao seeder 02',
                'abreviacao'    => 'Vr' ,
                'idioma_id'     => 3
            ]
        );
    }
}
