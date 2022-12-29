<?php

namespace Database\Seeders;

use App\Models\PlanStatuses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Statuses
        $statuses = [
            'Review',
            'In Progress',
            'Block',
            'Done',
        ];
       
        foreach ($statuses as $status) {
            PlanStatuses::create(['title' => $status]);
        }
    }
}
