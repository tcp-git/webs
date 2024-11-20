<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('members')->insert([
            [
                'id' => 1,
                'room_id' => '1',
                'name' => 'myname1',
                'reference1' => '202408250000001',
                'reference2' => '0000001',
                'reference3' => null,
                'doctor' => 1,
                'moderator' => 1,
                'mic' => 1,
                'vdo' => 1,
                'shared' => 1,
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'room_id' => '1',
                'name' => 'myname2',
                'reference1' => '202408250000002',
                'reference2' => '0000002',
                'reference3' => null,
                'doctor' => 0,
                'moderator' => 0,
                'mic' => 1,
                'vdo' => 1,
                'shared' => 1,
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'room_id' => '1',
                'name' => 'myname3',
                'reference1' => '202408250000003',
                'reference2' => '0000003',
                'reference3' => null,
                'doctor' => 0,
                'moderator' => 0,
                'mic' => 1,
                'vdo' => 1,
                'shared' => 1,
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'room_id' => '2',
                'name' => 'myname4',
                'reference1' => '202408250000004',
                'reference2' => '0000004',
                'reference3'=> null,
                'doctor' => null,
                'moderator' => 1,
                'mic' => 1,
                'vdo' => 1,
                'shared' => 1,
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'room_id' => '3',
                'name' => 'myname5',
                'reference1' => '202408250000005',
                'reference2' => '0000005',
                'reference3'=> null,
                'doctor' => null,
                'moderator' => 1,
                'mic' => 1,
                'vdo' => 1,
                'shared' => 1,
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'room_id' => '3',
                'name' => 'myname6',
                'reference1' => '202408250000006',
                'reference2' => '0000006',
                'reference3'=> null,
                'doctor' => null,
                'moderator' => 0,
                'mic' => 1,
                'vdo' => 1,
                'shared' => 1,
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
