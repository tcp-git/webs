<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organizations')->insert([
            [
                'id' => 1,
                'name' => 'โรงพยาบาลราชบุรี',
                'active' => 1,
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'โรงพบาบาลพญาไท',
                'active' => 1,
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }

}
