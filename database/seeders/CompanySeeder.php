<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'amazon',
            'address' => 'Av.Luna, calle 22 y 53',
            'function' => 'paqueteria',
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);   
        DB::table('companies')->insert([
            'name' => 'wonka',
            'address' => 'Av.kabah, calle 34A',
            'function' => 'dulceria',
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);   
    }
}
