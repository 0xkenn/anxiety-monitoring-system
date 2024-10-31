<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    public function run()
    {
        // Programs for STCS
        Program::create(['program_name' => 'BSIT', 'school_id' => 1]);
        Program::create(['program_name' => 'BSCS', 'school_id' => 1]);
        Program::create(['program_name' => 'BSIS', 'school_id' => 1]);

        // Programs for SME
        Program::create(['program_name' => 'Hotel Management', 'school_id' => 2]);
        Program::create(['program_name' => 'Tourism Management', 'school_id' => 2]);

        // Programs for STED
        Program::create(['program_name' => 'BSM-English', 'school_id' => 3]);
        Program::create(['program_name' => 'BSM-Mathematics', 'school_id' => 3]);
        Program::create(['program_name' => 'BSM-Filipino', 'school_id' => 3]);
        Program::create(['program_name' => 'BSM-Social Studies', 'school_id' => 3]);
        Program::create(['program_name' => 'BPE', 'school_id' => 3]);
        Program::create(['program_name' => 'BSNE', 'school_id' => 3]);
        Program::create(['program_name' => 'BSM-Science', 'school_id' => 3]);
        Program::create(['program_name' => 'BEE', 'school_id' => 3]);
        Program::create(['program_name' => 'BTLE', 'school_id' => 3]);

        // Programs for SOE
        Program::create(['program_name' => 'Civil Engineering', 'school_id' => 4]);
        Program::create(['program_name' => 'Mechanical Engineering', 'school_id' => 4]);
        Program::create(['program_name' => 'Electrical Engineering', 'school_id' => 4]);
        Program::create(['program_name' => 'Computer Engineering', 'school_id' => 4]);

        // Programs for SAS
        Program::create(['program_name' => 'BSBA', 'school_id' => 5]);
        Program::create(['program_name' => 'BAE', 'school_id' => 5]);
        Program::create(['program_name' => 'BSAC', 'school_id' => 5]);
    }
}
