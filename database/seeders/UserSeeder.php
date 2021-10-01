<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Matilda',
            'lastName' => 'Perez',
            'age' => 20,
            'email' => 'matilda@example.com', 
            'telephone' => '0123456789',
            'jobTitle' => 'administrador',
            'username' => 'matilda_65',
            'password' => Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('users')->insert([
            'name' => 'Roberto',
            'lastName' => 'Fuentes',
            'age' => 36,
            'email' => 'roberto@example.com', 
            'telephone' => '1234567890',
            'jobTitle' => 'gerente',
            'username' => 'roberto_36',
            'password' => Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('users')->insert([
            'name' => 'Francisco',
            'lastName' => 'Rodriguez',
            'age' => 45,
            'email' => 'francisco@example.com', 
            'telephone' => '123654890',
            'jobTitle' => 'gerente',
            'username' => 'francisco_45',
            'password' => Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('users')->insert([
            'name' => 'Mariana',
            'lastName' => 'Estrella',
            'age' => 65,
            'email' => 'mariana@example.com', 
            'telephone' => '01156456789',
            'jobTitle' => 'supervisor',
            'username' => 'mariana_65',
            'password' => Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('users')->insert([
            'name' => 'Rosio',
            'lastName' => 'Ek',
            'age' => 43,
            'email' => 'rosio@example.com', 
            'telephone' => '011562246789',
            'jobTitle' => 'supervisor',
            'username' => 'rosio_43',
            'password' => Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('users')->insert([
            'name' => 'Pedro',
            'lastName' => 'Solita',
            'age' => 78,
            'email' => 'pedro@example.com', 
            'telephone' => '011563946789',
            'jobTitle' => 'supervisor',
            'username' => 'pedro_78',
            'password' => Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('users')->insert([
            'name' => 'Rigoberto',
            'lastName' => 'Escamilla',
            'age' => 37,
            'email' => 'rigoberto@example.com', 
            'telephone' => '01156456549',
            'jobTitle' => 'supervisor',
            'username' => 'rigoberto_37',
            'password' => Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('users')->insert([
            'name' => 'Julio',
            'lastName' => 'Romez',
            'age' => 54,
            'email' => 'julio@example.com', 
            'telephone' => '0123456239',
            'jobTitle' => 'empleado',
            'username' => 'julio_54',
            'password' => Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('users')->insert([
            'name' => 'Ramiro',
            'lastName' => 'Gomez',
            'age' => 54,
            'email' => 'ramiro@example.com', 
            'telephone' => '0753456239',
            'jobTitle' => 'empleado',
            'username' => 'ramiro_54',
            'password' => Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('users')->insert([
            'name' => 'Alejandro',
            'lastName' => 'Ruiz',
            'age' => 53,
            'email' => 'alejandro@example.com', 
            'telephone' => '0343456239',
            'jobTitle' => 'empleado',
            'username' => 'alejandro_53',
            'password' => Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('users')->insert([
            'name' => 'Luz',
            'lastName' => 'Garia',
            'age' => 21,
            'email' => 'luz@example.com', 
            'telephone' => '0753456239',
            'jobTitle' => 'empleado',
            'username' => 'luz_21',
            'password' => Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);

        DB::table('users')->insert([
            'name' => 'Belanoba',
            'lastName' => 'Casas',
            'age' => 22,
            'email' => 'belanoba@example.com', 
            'telephone' => '0753456239',
            'jobTitle' => 'empleado',
            'username' => 'Belanoba_22',
            'password' => Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);

        DB::table('users')->insert([
            'name' => 'Juan',
            'lastName' => 'Mendez',
            'age' => 23,
            'email' => 'juan@example.com', 
            'telephone' => '0233456239',
            'jobTitle' => 'empleado',
            'username' => 'juan_23',
            'password' => Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);


        DB::table('users')->insert([
            'name' => 'Sergio',
            'lastName' => 'Tierra',
            'age' => 24,
            'email' => 'sergio@example.com', 
            'telephone' => '07534562329',
            'jobTitle' => 'empleado',
            'username' => 'sergio_24',
            'password' => Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);

        DB::table('users')->insert([
            'name' => 'Azul',
            'lastName' => 'Bella',
            'age' => 25,
            'email' => 'azul@example.com', 
            'telephone' => '1753456239',
            'jobTitle' => 'empleado',
            'username' => 'azul_25',
            'password' => Hash::make('12345'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);




    }
}
