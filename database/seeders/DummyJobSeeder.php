<?php

namespace Database\Seeders;

use App\Models\CareerLevel;
use App\Models\Company;
use App\Models\FunctionalArea;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobShift;
use App\Models\JobType;
use App\Models\RequiredDegreeLevel;
use App\Models\SalaryCurrency;
use App\Models\SalaryPeriod;
use App\Models\Skill;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummyJobSeeder extends Seeder
{
    public function run(): void
    {
        $currencyId = SalaryCurrency::query()->value('id');
        $salaryPeriodId = SalaryPeriod::query()->value('id');
        $jobTypeId = JobType::query()->value('id');
        $careerLevelId = CareerLevel::query()->value('id');
        $functionalAreaId = FunctionalArea::query()->value('id');
        $jobShiftId = JobShift::query()->value('id');
        $degreeLevelId = RequiredDegreeLevel::query()->value('id');

        if (! $currencyId || ! $salaryPeriodId || ! $jobTypeId || ! $functionalAreaId) {
            $this->command?->warn('Missing required master data. Seed currencies, salary periods, job types, shifts, functional areas, and degree levels first.');

            return;
        }

        $educationCategoryIds = [
            'school' => $this->findCategoryId(['school', 'school teacher']),
            'college' => $this->findCategoryId(['college', 'college/university', 'university']),
            'preschool' => $this->findCategoryId(['pre-school', 'preschool']),
            'coaching' => $this->findCategoryId(['coaching', 'training']),
        ];

        $companies = Company::with('user')
            ->whereIn('user_id', function ($query) {
                $query->select('id')->from('users')->whereIn('email', [
                    'employerdemo1@bizwoke.com',
                    'employerdemo2@bizwoke.com',
                    'employerdemo3@bizwoke.com',
                ]);
            })
            ->get()
            ->values();

        if ($companies->isEmpty()) {
            $this->command?->warn('No dummy employers found. Seed DummyEmployerSeeder first.');

            return;
        }

        $jobs = [
            [
                'job_title' => 'Mathematics Teacher',
                'category_id' => $educationCategoryIds['school'],
                'description' => 'Teach middle and senior school mathematics, prepare lesson plans, assess student progress, and support exam preparation for board classes.',
                'key_responsibilities' => 'Create lesson plans, conduct assessments, mentor students, and coordinate with parents and academic heads.',
                'salary_from' => 300000,
                'salary_to' => 480000,
                'experience' => 2,
                'position' => 'Teacher',
                'company_index' => 0,
            ],
            [
                'job_title' => 'English Teacher',
                'category_id' => $educationCategoryIds['school'],
                'description' => 'Handle English language and literature classes, improve grammar and communication skills, and prepare students for annual examinations.',
                'key_responsibilities' => 'Deliver engaging classroom teaching, check assignments, and develop reading and speaking programs.',
                'salary_from' => 280000,
                'salary_to' => 450000,
                'experience' => 2,
                'position' => 'Teacher',
                'company_index' => 0,
            ],
            [
                'job_title' => 'Pre-Primary Teacher',
                'category_id' => $educationCategoryIds['preschool'],
                'description' => 'Manage early years classroom activities, phonics learning, storytelling, and age-appropriate classroom development for preschool learners.',
                'key_responsibilities' => 'Plan classroom activities, maintain student records, and support child development milestones.',
                'salary_from' => 220000,
                'salary_to' => 360000,
                'experience' => 1,
                'position' => 'Teacher',
                'company_index' => 0,
            ],
            [
                'job_title' => 'Physics Lecturer',
                'category_id' => $educationCategoryIds['college'],
                'description' => 'Teach undergraduate physics courses, maintain lab engagement, and support students with practical and theoretical concepts.',
                'key_responsibilities' => 'Deliver lectures, supervise labs, prepare internal assessments, and guide academic projects.',
                'salary_from' => 420000,
                'salary_to' => 650000,
                'experience' => 3,
                'position' => 'Lecturer',
                'company_index' => 1,
            ],
            [
                'job_title' => 'Assistant Professor - Commerce',
                'category_id' => $educationCategoryIds['college'],
                'description' => 'Teach commerce subjects for degree students and contribute to curriculum planning, academic mentoring, and departmental activities.',
                'key_responsibilities' => 'Handle classes, support university compliance, and guide student presentations and assignments.',
                'salary_from' => 500000,
                'salary_to' => 780000,
                'experience' => 4,
                'position' => 'Assistant Professor',
                'company_index' => 1,
            ],
            [
                'job_title' => 'Admission Counselor',
                'category_id' => $educationCategoryIds['college'],
                'description' => 'Support student admissions, guide parents through program options, and manage inquiry conversion for an educational institution.',
                'key_responsibilities' => 'Handle leads, schedule campus visits, counsel parents, and maintain admission records.',
                'salary_from' => 260000,
                'salary_to' => 420000,
                'experience' => 2,
                'position' => 'Counselor',
                'company_index' => 1,
            ],
            [
                'job_title' => 'Science Teacher',
                'category_id' => $educationCategoryIds['school'],
                'description' => 'Teach integrated science concepts, conduct demonstrations, and build strong conceptual understanding among school students.',
                'key_responsibilities' => 'Prepare lesson plans, run practical sessions, and evaluate student performance regularly.',
                'salary_from' => 300000,
                'salary_to' => 470000,
                'experience' => 2,
                'position' => 'Teacher',
                'company_index' => 2,
            ],
            [
                'job_title' => 'Biology Faculty - NEET Coaching',
                'category_id' => $educationCategoryIds['coaching'],
                'description' => 'Train NEET aspirants in biology, deliver concept-driven lectures, and solve test series and doubt sessions effectively.',
                'key_responsibilities' => 'Conduct coaching classes, prepare question banks, and review mock test performance.',
                'salary_from' => 550000,
                'salary_to' => 900000,
                'experience' => 4,
                'position' => 'Faculty',
                'company_index' => 2,
            ],
            [
                'job_title' => 'Academic Coordinator',
                'category_id' => $educationCategoryIds['school'],
                'description' => 'Coordinate academic planning, teacher schedules, classroom quality, and student reporting for a K-12 institution.',
                'key_responsibilities' => 'Monitor curriculum delivery, support teachers, and maintain academic quality standards.',
                'salary_from' => 400000,
                'salary_to' => 620000,
                'experience' => 5,
                'position' => 'Coordinator',
                'company_index' => 0,
            ],
            [
                'job_title' => 'Computer Teacher',
                'category_id' => $educationCategoryIds['school'],
                'description' => 'Teach computer fundamentals, coding basics, and digital literacy skills for upper primary and secondary students.',
                'key_responsibilities' => 'Conduct computer lab sessions, develop projects, and improve digital skills across classes.',
                'salary_from' => 320000,
                'salary_to' => 500000,
                'experience' => 2,
                'position' => 'Teacher',
                'company_index' => 2,
            ],
        ];

        $skillIds = Skill::query()->limit(3)->pluck('id')->all();

        foreach ($jobs as $index => $jobData) {
            $company = $companies[$jobData['company_index'] % $companies->count()];

            $job = Job::updateOrCreate(
                ['job_id' => 'DUMMY-JOB-'.str_pad((string) ($index + 1), 3, '0', STR_PAD_LEFT)],
                [
                    'job_title' => $jobData['job_title'],
                    'description' => $jobData['description'],
                    'salary_from' => $jobData['salary_from'],
                    'salary_to' => $jobData['salary_to'],
                    'company_id' => $company->id,
                    'job_category_id' => $jobData['category_id'],
                    'currency_id' => $currencyId,
                    'salary_period_id' => $salaryPeriodId,
                    'job_type_id' => $jobTypeId,
                    'career_level_id' => $careerLevelId,
                    'functional_area_id' => $functionalAreaId,
                    'job_shift_id' => $jobShiftId,
                    'degree_level_id' => $degreeLevelId,
                    'position' => $jobData['position'],
                    'experience' => $jobData['experience'],
                    'job_expiry_date' => Carbon::now()->addMonths(2)->toDateString(),
                    'no_preference' => Job::YES,
                    'hide_salary' => 0,
                    'is_freelance' => 0,
                    'is_suspended' => Job::NOT_SUSPENDED,
                    'country_id' => $company->user?->country_id,
                    'state_id' => $company->user?->state_id,
                    'city_id' => $company->user?->city_id,
                    'status' => Job::STATUS_OPEN,
                    'is_created_by_admin' => 1,
                    'last_change' => 1,
                    'key_responsibilities' => $jobData['key_responsibilities'],
                    'reject_reason' => null,
                ]
            );

            if (! empty($skillIds)) {
                $job->jobsSkill()->sync($skillIds);
            }
        }

        $this->command?->info('Dummy education jobs seeded successfully.');
    }

    private function findCategoryId(array $keywords): int
    {
        foreach ($keywords as $keyword) {
            $category = JobCategory::query()->where('name', 'like', '%'.$keyword.'%')->first();
            if ($category) {
                return $category->id;
            }
        }

        return JobCategory::query()->value('id');
    }
}
