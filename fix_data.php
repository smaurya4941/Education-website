<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\Job;
use App\Models\CandidateEducation;
use App\Models\JobType;
use App\Models\JobCategory;
use App\Models\Skill;
use App\Models\FunctionalArea;
use App\Models\JobShift;
use App\Models\Tag;
use App\Models\CareerLevel;
use App\Models\SalaryPeriod;
use App\Models\RequiredDegreeLevel;

// Get the first valid IDs
$firstDegreeLevelId = RequiredDegreeLevel::first()->id;
$firstJobTypeId = JobType::first()->id;
$firstJobCategoryId = JobCategory::first()->id;
$firstFunctionalAreaId = FunctionalArea::first()->id;
$firstJobShiftId = JobShift::first()->id;
$firstCareerLevelId = CareerLevel::first()->id;
$firstSalaryPeriodId = SalaryPeriod::first()->id;
$firstSkillId = Skill::first()->id;
$firstTagId = Tag::first()->id;

DB::statement('SET FOREIGN_KEY_CHECKS=0;');

// 1. Fix CandidateEducations
CandidateEducation::whereNotIn('degree_level_id', RequiredDegreeLevel::pluck('id'))->update(['degree_level_id' => $firstDegreeLevelId]);

// 2. Fix Jobs
Job::whereNotIn('job_type_id', JobType::pluck('id'))->update(['job_type_id' => $firstJobTypeId]);
Job::whereNotIn('job_category_id', JobCategory::pluck('id'))->update(['job_category_id' => $firstJobCategoryId]);
Job::whereNotIn('functional_area_id', FunctionalArea::pluck('id'))->update(['functional_area_id' => $firstFunctionalAreaId]);
Job::whereNotIn('job_shift_id', JobShift::pluck('id'))->update(['job_shift_id' => $firstJobShiftId]);
Job::whereNotIn('career_level_id', CareerLevel::pluck('id'))->update(['career_level_id' => $firstCareerLevelId]);
Job::whereNotIn('salary_period_id', SalaryPeriod::pluck('id'))->update(['salary_period_id' => $firstSalaryPeriodId]);
Job::whereNotNull('degree_level_id')->whereNotIn('degree_level_id', RequiredDegreeLevel::pluck('id'))->update(['degree_level_id' => $firstDegreeLevelId]);

// 3. Pivot tables
// jobs_skill
DB::table('jobs_skill')->whereNotIn('skill_id', Skill::pluck('id'))->update(['skill_id' => $firstSkillId]);
// jobs_tag
DB::table('jobs_tag')->whereNotIn('tag_id', Tag::pluck('id'))->update(['tag_id' => $firstTagId]);
// candidate_skills
DB::table('candidate_skills')->whereNotIn('skill_id', Skill::pluck('id'))->update(['skill_id' => $firstSkillId]);

// 4. Any others? Candidate experiences?
// Checking Candidates table
if (\Schema::hasColumn('candidates', 'career_level_id')) {
    DB::table('candidates')->whereNotNull('career_level_id')->whereNotIn('career_level_id', CareerLevel::pluck('id'))->update(['career_level_id' => $firstCareerLevelId]);
}
if (\Schema::hasColumn('candidates', 'functional_area_id')) {
    DB::table('candidates')->whereNotNull('functional_area_id')->whereNotIn('functional_area_id', FunctionalArea::pluck('id'))->update(['functional_area_id' => $firstFunctionalAreaId]);
}

DB::statement('SET FOREIGN_KEY_CHECKS=1;');

echo "Data consistency fixed. Orphaned records re-mapped.\n";
