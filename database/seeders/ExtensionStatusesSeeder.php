<?php

namespace Database\Seeders;

use App\Models\ExtensionStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtensionStatusesSeeder extends Seeder
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
            'Stable',
            'In Plan',
            'Review',
            'Require',
            'Pending Update'
        ];
       
        foreach ($statuses as $status) {
            ExtensionStatus::create(['title' => $status]);
        }
    }
}
