<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegisterbranchofficesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('registerbranchoffices')->insert([
            'userId' => 4,
            'branchOfficeId' =>  1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('registerbranchoffices')->insert([
            'userId' => 5,
            'branchOfficeId' => 2,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('registerbranchoffices')->insert([
            'userId' => 6,
            'branchOfficeId' =>  3,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('registerbranchoffices')->insert([
            'userId' => 7,
            'branchOfficeId' => 4,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('registerbranchoffices')->insert([
            'userId' => 8,
            'branchOfficeId' =>  1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('registerbranchoffices')->insert([
            'userId' => 9,
            'branchOfficeId' =>  1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('registerbranchoffices')->insert([
            'userId' => 10,
            'branchOfficeId' =>  2,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('registerbranchoffices')->insert([
            'userId' => 11,
            'branchOfficeId' =>  2,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('registerbranchoffices')->insert([
            'userId' => 12,
            'branchOfficeId' =>  3,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('registerbranchoffices')->insert([
            'userId' => 12,
            'branchOfficeId' =>  3,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('registerbranchoffices')->insert([
            'userId' => 13,
            'branchOfficeId' =>  4,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('registerbranchoffices')->insert([
            'userId' => 14,
            'branchOfficeId' =>  4,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
    }
}
