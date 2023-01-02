<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ExtensionStatus;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            ExtensionStatusesSeeder::class,
            PlanStatusesSeeder::class,
            PlanPrioritySeeder::class
        ]);
    }
}
