<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name' => 'Information Technology',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::table('departments')->insert([
            'name' => 'Computer Information Systems',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::table('departments')->insert([
            'name' => 'Computer Sinces',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
