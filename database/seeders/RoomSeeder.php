<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startTime = date("Y-m-d H:i:s");
        $endTime = date("Y-m-d H:i:s",strtotime('+1 hour',strtotime($startTime)));
        DB::table('rooms')->insert([
            [
                'id' => 1,
                'name' => 'rbh001',
                'service_id' => 1,
                'start_at' => now(),
                'end_at' => now()->addHour(2),
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'dhs001',
                'service_id' => 2,
                'start_at' => now(),
                'end_at' => now()->addHour(2),
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'iTele001',
                'service_id' => 3,
                'start_at' => now(),
                'end_at' => now()->addHour(2),
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
