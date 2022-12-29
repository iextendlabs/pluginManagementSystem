<?php

namespace Database\Seeders;

use App\Models\PlanPriority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Priority
        $priorities = [
            'Blocker',
            'Back Look',
            'Hy',
            'Top',
        ];
       
        foreach ($priorities as $Priority) {
            PlanPriority::create(['title' => $Priority]);
        }
    }
}
