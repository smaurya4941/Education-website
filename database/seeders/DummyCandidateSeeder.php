<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\CareerLevel;
use App\Models\City;
use App\Models\Country;
use App\Models\FunctionalArea;
use App\Models\Industry;
use App\Models\Language;
use App\Models\MaritalStatus;
use App\Models\SalaryCurrency;
use App\Models\Skill;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DummyCandidateSeeder extends Seeder
{
    public function run(): void
    {
        $candidateRole = Role::whereName('Candidate')->first();
        $maritalStatusId = MaritalStatus::query()->value('id');
        $careerLevelId = CareerLevel::query()->value('id');
        $industryId = Industry::query()->value('id');
        $functionalAreaId = FunctionalArea::query()->value('id');
        $salaryCurrency = SalaryCurrency::query()->value('currency_name');
        $skillIds = Skill::query()->limit(3)->pluck('id')->all();
        $languageIds = Language::query()->limit(2)->pluck('id')->all();

        if (! $candidateRole || ! $maritalStatusId) {
            $this->command?->warn('Missing required master data. Seed roles and marital status first.');

            return;
        }

        $locations = [
            $this->resolveLocation('India', 'Karnataka', 'Bengaluru'),
            $this->resolveLocation('India', 'Maharashtra', 'Pune'),
            $this->resolveLocation('India', 'Telangana', 'Hyderabad'),
            $this->resolveLocation('India', 'Tamil Nadu', 'Chennai'),
            $this->resolveLocation('India', 'West Bengal', 'Kolkata'),
            $this->resolveLocation('India', 'Uttar Pradesh', 'Lucknow'),
            $this->resolveLocation('India', 'Delhi', 'Delhi'),
            $this->resolveLocation('India', 'Gujarat', 'Ahmedabad'),
        ];

        $candidates = [
            ['first_name' => 'Riya', 'last_name' => 'Sharma', 'email' => 'candidate1@bizwoke.com', 'phone' => '9876500001', 'city_label' => 'Bengaluru', 'location' => $locations[0]],
            ['first_name' => 'Arjun', 'last_name' => 'Mehta', 'email' => 'candidate2@bizwoke.com', 'phone' => '9876500002', 'city_label' => 'Pune', 'location' => $locations[1]],
            ['first_name' => 'Sneha', 'last_name' => 'Reddy', 'email' => 'candidate3@bizwoke.com', 'phone' => '9876500003', 'city_label' => 'Hyderabad', 'location' => $locations[2]],
            ['first_name' => 'Vikram', 'last_name' => 'Iyer', 'email' => 'candidate4@bizwoke.com', 'phone' => '9876500004', 'city_label' => 'Chennai', 'location' => $locations[3]],
            ['first_name' => 'Pooja', 'last_name' => 'Sen', 'email' => 'candidate5@bizwoke.com', 'phone' => '9876500005', 'city_label' => 'Kolkata', 'location' => $locations[4]],
            ['first_name' => 'Rahul', 'last_name' => 'Tiwari', 'email' => 'candidate6@bizwoke.com', 'phone' => '9876500006', 'city_label' => 'Lucknow', 'location' => $locations[5]],
            ['first_name' => 'Ananya', 'last_name' => 'Kapoor', 'email' => 'candidate7@bizwoke.com', 'phone' => '9876500007', 'city_label' => 'Delhi', 'location' => $locations[6]],
            ['first_name' => 'Karan', 'last_name' => 'Patel', 'email' => 'candidate8@bizwoke.com', 'phone' => '9876500008', 'city_label' => 'Ahmedabad', 'location' => $locations[7]],
        ];

        foreach ($candidates as $index => $candidateData) {
            $user = User::updateOrCreate(
                ['email' => $candidateData['email']],
                [
                    'first_name' => $candidateData['first_name'],
                    'last_name' => $candidateData['last_name'],
                    'phone' => $candidateData['phone'],
                    'password' => Hash::make('123456'),
                    'dob' => Carbon::now()->subYears(22 + $index)->toDateString(),
                    'gender' => $index % 2,
                    'country_id' => $candidateData['location']['country_id'],
                    'state_id' => $candidateData['location']['state_id'],
                    'city_id' => $candidateData['location']['city_id'],
                    'is_active' => 1,
                    'is_verified' => 1,
                    'email_verified_at' => Carbon::now(),
                    'region_code' => '+91',
                ]
            );

            $candidate = Candidate::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'unique_id' => 'DUMMY-CAND-'.($index + 1),
                    'father_name' => 'Demo Parent '.($index + 1),
                    'marital_status_id' => $maritalStatusId,
                    'nationality' => 'Indian',
                    'national_id_card' => 'IDCARD00'.($index + 1),
                    'experience' => 1 + $index,
                    'career_level_id' => $careerLevelId,
                    'industry_id' => $industryId,
                    'functional_area_id' => $functionalAreaId,
                    'current_salary' => 250000 + ($index * 50000),
                    'expected_salary' => 350000 + ($index * 50000),
                    'salary_currency' => $salaryCurrency,
                    'address' => 'Demo address in '.$candidateData['city_label'],
                    'immediate_available' => 1,
                    'available_at' => null,
                    'last_change' => 1,
                ]
            );

            $user->update([
                'owner_id' => $candidate->id,
                'owner_type' => Candidate::class,
            ]);

            if (! $user->hasRole('Candidate')) {
                $user->assignRole($candidateRole);
            }

            if (! empty($skillIds)) {
                $user->candidateSkill()->syncWithoutDetaching($skillIds);
            }

            if (! empty($languageIds)) {
                $user->candidateLanguage()->syncWithoutDetaching($languageIds);
            }
        }

        $this->command?->info('Dummy candidates seeded successfully. Login password for all seeded candidates: 123456');
    }

    private function resolveLocation(string $countryName, string $stateName, string $cityName): array
    {
        $country = Country::query()->where('name', 'like', $countryName)->first() ?? Country::query()->first();
        $state = State::query()
            ->when($country, fn ($query) => $query->where('country_id', $country->id))
            ->where('name', 'like', $stateName)
            ->first();

        if (! $state) {
            $state = State::query()
                ->when($country, fn ($query) => $query->where('country_id', $country->id))
                ->first();
        }

        $city = City::query()
            ->when($state, fn ($query) => $query->where('state_id', $state->id))
            ->where('name', 'like', $cityName)
            ->first();

        if (! $city) {
            $city = City::query()
                ->when($state, fn ($query) => $query->where('state_id', $state->id))
                ->first();
        }

        return [
            'country_id' => $country?->id,
            'state_id' => $state?->id,
            'city_id' => $city?->id,
        ];
    }
}
