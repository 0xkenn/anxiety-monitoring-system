<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;

class SchoolSeeder extends Seeder
{
    public function run()
    {
        School::create(['school_name' => 'STCS']);
        School::create(['school_name' => 'SME']);
        School::create(['school_name' => 'STED']);
        School::create(['school_name' => 'SOE']);
        School::create(['school_name' => 'SAS']);
        School::create(['school_name' => 'LHS']);
        School::create(['school_name' => 'SCJE']);
        School::create(['school_name' => 'SNHS']);
    }
}
