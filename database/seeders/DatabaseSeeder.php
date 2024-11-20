<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\RoomSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\MemberSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\OrganizationSeeder;
use Database\Seeders\PermissionRoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            ServiceSeeder::class,
            RoomSeeder::class,
            RoleSeeder::class,
            OrganizationSeeder::class,
            MemberSeeder::class,
            PermissionSeeder::class,
            PermissionRoleSeeder::class,
        ]);

    }
}
