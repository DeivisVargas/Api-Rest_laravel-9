<?php

namespace Database\Seeders;

use App\Models\Testamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //chama o model
        Testamento::create(
            [
                'nome'  => 'Novo testamento seeder 01'
            ]
        );
        Testamento::create(
            [
                'nome'  => 'Novo testamento seeder 02'
            ]
        );
        Testamento::create(
            [
                'nome'  => 'Novo testamento seeder 03'
            ]
        );
    }
}
