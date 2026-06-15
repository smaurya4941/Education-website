<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Company;
use App\Models\CompanySize;
use App\Models\Country;
use App\Models\Industry;
use App\Models\OwnerShipType;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DummyEmployerSeeder extends Seeder
{
    public function run(): void
    {
        $industryId = Industry::query()->value('id');
        $ownershipTypeId = OwnerShipType::query()->value('id');
        $companySizeId = CompanySize::query()->value('id');
        $employerRole = Role::whereName('Employer')->first();

        if (! $industryId || ! $ownershipTypeId || ! $companySizeId || ! $employerRole) {
            $this->command?->warn('Missing required master data. Seed roles, industries, ownership types, and company sizes first.');

            return;
        }

        $locations = [
            $this->resolveLocation('India', 'Karnataka', 'Bengaluru'),
            $this->resolveLocation('India', 'Maharashtra', 'Pune'),
            $this->resolveLocation('India', 'Telangana', 'Hyderabad'),
        ];

        $employers = [
            [
                'name' => 'Bizwoke Demo Employer',
                'email' => 'employerdemo1@bizwoke.com',
                'ceo' => 'Sachin Kumar',
                'phone' => '9876543210',
                'location' => 'Bengaluru, Karnataka, India',
                'location2' => 'Koramangala, Bengaluru',
                'website' => 'https://example.com',
                'fax' => '08012345678',
                'facebook_url' => 'https://www.facebook.com/bizwokedemo',
                'twitter_url' => 'https://www.twitter.com/bizwokedemo',
                'linkedin_url' => 'https://www.linkedin.com/company/bizwokedemo',
                'google_plus_url' => 'https://plus.google.com',
                'pinterest_url' => 'https://www.pinterest.com/bizwokedemo',
                'details' => 'Bizwoke Demo Employer is a sample employer account created for testing employer management, company profile setup, and job posting flows in the Bizwoke jobs portal.',
                'no_of_offices' => 3,
                'region_code' => '+91',
                'location_data' => $locations[0],
            ],
            [
                'name' => 'Bizwoke Hiring Solutions',
                'email' => 'employerdemo2@bizwoke.com',
                'ceo' => 'Amit Sharma',
                'phone' => '9876543211',
                'location' => 'Pune, Maharashtra, India',
                'location2' => 'Hinjewadi, Pune',
                'website' => 'https://example.org',
                'fax' => '02012345678',
                'facebook_url' => 'https://www.facebook.com/bizwokehiring',
                'twitter_url' => 'https://www.twitter.com/bizwokehiring',
                'linkedin_url' => 'https://www.linkedin.com/company/bizwokehiring',
                'google_plus_url' => 'https://plus.google.com',
                'pinterest_url' => 'https://www.pinterest.com/bizwokehiring',
                'details' => 'Bizwoke Hiring Solutions is a test employer profile used for validating employer onboarding, location-based search, and demo job posting scenarios.',
                'no_of_offices' => 2,
                'region_code' => '+91',
                'location_data' => $locations[1],
            ],
            [
                'name' => 'Bizwoke Talent Partners',
                'email' => 'employerdemo3@bizwoke.com',
                'ceo' => 'Neha Verma',
                'phone' => '9876543212',
                'location' => 'Hyderabad, Telangana, India',
                'location2' => 'Madhapur, Hyderabad',
                'website' => 'https://example.net',
                'fax' => '04012345678',
                'facebook_url' => 'https://www.facebook.com/bizwoketalent',
                'twitter_url' => 'https://www.twitter.com/bizwoketalent',
                'linkedin_url' => 'https://www.linkedin.com/company/bizwoketalent',
                'google_plus_url' => 'https://plus.google.com',
                'pinterest_url' => 'https://www.pinterest.com/bizwoketalent',
                'details' => 'Bizwoke Talent Partners is dummy employer data for QA testing across employer dashboards, jobs, and candidate application flows.',
                'no_of_offices' => 4,
                'region_code' => '+91',
                'location_data' => $locations[2],
            ],
        ];

        foreach ($employers as $index => $employer) {
            $company = Company::updateOrCreate(
                ['unique_id' => 'DUMMY-EMP-'.($index + 1)],
                [
                    'ceo' => $employer['ceo'],
                    'industry_id' => $industryId,
                    'ownership_type_id' => $ownershipTypeId,
                    'company_size_id' => $companySizeId,
                    'established_in' => 2020,
                    'details' => $employer['details'],
                    'website' => $employer['website'],
                    'location' => $employer['location'],
                    'location2' => $employer['location2'],
                    'no_of_offices' => $employer['no_of_offices'],
                    'fax' => $employer['fax'],
                    'last_change' => 1,
                ]
            );

            $user = User::updateOrCreate(
                ['email' => $employer['email']],
                [
                    'first_name' => $employer['name'],
                    'phone' => $employer['phone'],
                    'password' => Hash::make('123456'),
                    'country_id' => $employer['location_data']['country_id'],
                    'state_id' => $employer['location_data']['state_id'],
                    'city_id' => $employer['location_data']['city_id'],
                    'is_active' => 1,
                    'is_verified' => 1,
                    'email_verified_at' => Carbon::now(),
                    'owner_id' => $company->id,
                    'owner_type' => Company::class,
                    'facebook_url' => $employer['facebook_url'],
                    'twitter_url' => $employer['twitter_url'],
                    'linkedin_url' => $employer['linkedin_url'],
                    'google_plus_url' => $employer['google_plus_url'],
                    'pinterest_url' => $employer['pinterest_url'],
                    'region_code' => $employer['region_code'],
                ]
            );

            if (! $user->hasRole('Employer')) {
                $user->assignRole($employerRole);
            }

            $company->update(['user_id' => $user->id]);
        }

        $this->command?->info('Dummy employers seeded successfully. Login password for all seeded employers: 123456');
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
