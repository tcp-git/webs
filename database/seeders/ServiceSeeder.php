<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'id' => 1,
                'name' => 'rbh',
                'key' => Str::replace("-", "", Str::uuid()),
                'active' => 1,
                'organization_id' => 1,
                'limit_room' => 50,
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'dhs',
                'key' => Str::replace("-", "", Str::uuid()),
                'organization_id' => 1,
                'active' => 1,
                'limit_room' => 50,
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'iTele',
                'key' => Str::replace("-", "", Str::uuid()),
                'organization_id' => 1,
                'active' => 1,
                'limit_room' => 50,
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
