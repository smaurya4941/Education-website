<?php

namespace Database\Seeders;

use App\Models\SalaryPeriod;
use App\Models\RequiredDegreeLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateOptionsSeeder2 extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Salary Period
        SalaryPeriod::truncate();
        $salaryPeriods = [
            'Weekly Pay Period',
            'Bi-Weekly Pay Period',
            'Semi-Monthly Pay Period',
            'Monthly Pay Period',
            'Annually',
        ];
        foreach ($salaryPeriods as $name) {
            SalaryPeriod::create(['period' => $name]);
        }

        // Required Degree Level
        RequiredDegreeLevel::truncate();
        $degreeLevels = [
            "Bachelor's Degree (B.A., B.Sc., B.Com, B.Tech)",
            "Master's Degree (M.A., M.Sc., M.Com, M.Tech)",
            "B.Ed (Bachelor of Education)",
            "M.Ed (Master of Education)",
            "D.Ed (Diploma in Education)",
            "PGDM (Post Graduate Diploma)",
            "Ph.D.",
            "Professional Certifications (PGCE, TESOL, etc.)",
            "Other Post-Doctoral Qualifications",
        ];
        foreach ($degreeLevels as $name) {
            RequiredDegreeLevel::create(['name' => $name]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
