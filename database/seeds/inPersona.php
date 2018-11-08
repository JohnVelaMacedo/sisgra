<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class inPersona extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('persona')->insert([
            'DNI' => '74647666',
            'Nombre' => 'Oliver',
            'Apellidos' => 'Lozano',
            'Telefono' => '921433593',
            'Direccion' => 'Manantay',
            'idFacultad' => 2,
            'idEscuela' => 1,
            'Correo' => 'oliver@gmail.com',
            'estado' => 1,
        ]);
        DB::table('user')->insert([
            'id' => '74647666',
            'user' => '74647666',
            'password' => bcrypt('Inicio74647666'),
            'tipo' => 3,
            'estado' => 1
        ]);
    }
}
