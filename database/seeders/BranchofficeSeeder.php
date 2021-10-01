<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BranchofficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branchoffices')->insert([
            'address' => 'Av.Tulum calle 53A y 234',
            'startTime' => date('H:i:s', mktime(7,0,0)),
            'endTime' => date('H:i:s', mktime(10,0,0)),
            'companyId' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('branchoffices')->insert([
            'address' => 'Av.rancho viejo calle Z e Y',
            'startTime' => date('H:i:s', mktime(7,0,0)),
            'endTime' => date('H:i:s', mktime(10,0,0)),
            'companyId' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('branchoffices')->insert([
            'address' => 'Col.Valle verde',
            'startTime' => date('H:i:s', mktime(7,0,0)),
            'endTime' => date('H:i:s', mktime(10,0,0)),
            'companyId' => 2,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('branchoffices')->insert([
            'address' => 'Col.Avante',
            'startTime' => date('H:i:s', mktime(7,0,0)),
            'endTime' => date('H:i:s', mktime(10,0,0)),
            'companyId' => 2,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
    }
}
