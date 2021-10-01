<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->insert([
        'nameCustomer' => 'Francisco',
        'emailCustomer' => 'francisco@example.com',
        'telephoneCustomer' => '9985043136',
        'date' => date('Y-m-d', time()), 
        'time' => date('H:i:s', mktime(7,30,0)),
        'companyId' => 1,
        'branchOfficeId' => 1,
        'created_at' => date('Y-m-d H:i:s', time()),
        'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('appointments')->insert([
            'nameCustomer' => 'Eduardo',
            'emailCustomer' => 'eduardo@example.com',
            'telephoneCustomer' => '9994994199',
            'date' => date('Y-m-d', time()), 
            'time' => date('H:i:s', mktime(8,0,0)),
            'companyId' => 1,
            'branchOfficeId' => 2,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('appointments')->insert([
            'nameCustomer' => 'Maria',
            'emailCustomer' => 'maria@example.com',
            'telephoneCustomer' => '9987340321',
            'date' => date('Y-m-d', time()), 
            'time' => date('H:i:s', mktime(7,30,0)),
            'companyId' => 2,
            'branchOfficeId' => 3,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        DB::table('appointments')->insert([
            'nameCustomer' => 'Rosa',
            'emailCustomer' => 'rosa@example.com',
            'telephoneCustomer' => '9981228714',
            'date' => date('Y-m-d', time()), 
            'time' => date('H:i:s', mktime(8,0,0)),
            'companyId' => 2,
            'branchOfficeId' => 4,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
    }
}
