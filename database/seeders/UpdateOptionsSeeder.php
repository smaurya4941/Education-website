<?php

namespace Database\Seeders;

use App\Models\JobType;
use App\Models\JobCategory;
use App\Models\Skill;
use App\Models\FunctionalArea;
use App\Models\JobShift;
use App\Models\Tag;
use App\Models\CareerLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateOptionsSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 1. Job Type
        JobType::truncate();
        $jobTypes = [
            'Full-Time Permanent',
            'Full-Time Contract',
            'Part-Time',
            'Visiting / Guest Faculty',
            'Adjunct / Associate',
            'Internship / Fellowship',
            'Fixed-Term Contract (1-2 years)',
        ];
        foreach ($jobTypes as $name) {
            JobType::create(['name' => $name, 'is_default' => 1]);
        }

        // 2. Job Category
        JobCategory::truncate();
        $jobCategories = [
            'Pre-School / Nursery',
            'Primary School (Classes 1-5)',
            'Upper Primary (Classes 6-8)',
            'Secondary School (Classes 9-10)',
            'Senior Secondary (Classes 11-12)',
            'Diploma / Polytechnic Institute',
            'Undergraduate College',
            'Post-Graduate / Research University',
            'Professional Institute (Medical, Engineering, Law)',
            'Coaching / Tutorial Center',
            'Online Learning Platform',
            'EdTech Company',
        ];
        foreach ($jobCategories as $name) {
            JobCategory::create(['name' => $name, 'is_default' => 1, 'is_featured' => 0]);
        }

        // 3. Skill
        Skill::truncate();
        $skills = [
            'Subject Matter Expertise',
            'Curriculum Design & Development',
            'Classroom Management',
            'Digital Literacy (MS Office, Google Suite, LMS)',
            'Online Teaching Tools (Zoom, Google Meet, Blackboard)',
            'Assessment & Evaluation',
            'Student Mentoring & Counselling',
            'Research & Publication',
            'Communication Skills',
            'Leadership & Administration',
            'Educational Technology / EdTech',
            'Special Education / Inclusive Learning',
        ];
        foreach ($skills as $name) {
            Skill::create(['name' => $name, 'is_default' => 1]);
        }

        // 4. Functional Area
        FunctionalArea::truncate();
        $functionalAreas = [
            'Mathematics',
            'Science (Physics, Chemistry, Biology)',
            'English Language & Literature',
            'Social Sciences (History, Geography, Civics)',
            'Languages (Hindi, Regional Languages, Foreign Languages)',
            'Computer Science / IT',
            'Commerce (Accounting, Economics, Business Studies)',
            'Arts (Philosophy, Psychology, Sociology)',
            'Physical Education & Sports',
            'Fine Arts (Painting, Music, Dance, Drama)',
            'Engineering (Mechanical, Civil, Electrical, IT)',
            'Medical Sciences',
            'Administration / Management',
            'Library & Information Science',
            'Career Counselling',
        ];
        foreach ($functionalAreas as $name) {
            FunctionalArea::create(['name' => $name, 'is_default' => 1]);
        }

        // 5. Job Shift
        JobShift::truncate();
        $jobShifts = [
            'Morning Shift (6 AM - 2 PM)',
            'Afternoon Shift (1 PM - 6 PM)',
            'Full Day (6 AM - 6 PM with breaks)',
            'Evening Shift (4 PM - 8 PM)',
            'Flexible Hours',
            'Hybrid (Online + Classroom)',
            'Online / Remote',
            'As per Academic Calendar',
        ];
        foreach ($jobShifts as $name) {
            JobShift::create(['shift' => $name, 'is_default' => 1]);
        }

        // 6. Tag
        Tag::truncate();
        $tags = [
            'STEM (Science, Technology, Engineering, Math)',
            'Language Arts',
            'Research-Oriented',
            'Industry-Linked',
            'CBSE Curriculum',
            'ICSE Curriculum',
            'State Board',
            'International Curriculum (IB, Cambridge)',
            'Skill Development',
            'Extracurricular Activities',
            'Mentorship & Guidance',
            'EdTech Integration',
            'Special Education',
        ];
        foreach ($tags as $name) {
            Tag::create(['name' => $name, 'is_default' => 1]);
        }

        // 7. Career Level
        CareerLevel::truncate();
        $careerLevels = [
            'Trainee / Intern',
            'Junior Faculty (0-3 years)',
            'Faculty (3-7 years)',
            'Senior Faculty (7-15 years)',
            'Lead / Principal Faculty',
            'Head of Department',
            'Deputy Dean / Associate Dean',
            'Dean / Director',
            'Principal / Rector',
        ];
        foreach ($careerLevels as $name) {
            CareerLevel::create(['level_name' => $name, 'is_default' => 1]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
