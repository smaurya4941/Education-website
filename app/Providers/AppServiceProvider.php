<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Mariuzzo\LaravelJsLocalization\Commands\LangJsCommand;
use Mariuzzo\LaravelJsLocalization\Generators\LangJsGenerator;


use App\Models\City;
use App\Models\Job;
use App\Models\JobCategory;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Cashier::ignoreMigrations();
        $this->app->singleton('localization.js', function ($app) {
            $app = $this->app;
            $laravelMajorVersion = (int) $app::VERSION;

            $files = $app['files'];

            if ($laravelMajorVersion === 4) {
                $langs = $app['path.base'].'/app/lang';
            } elseif ($laravelMajorVersion >= 5 && $laravelMajorVersion < 9) {
                $langs = $app['path.base'].'/resources/lang';
            } elseif ($laravelMajorVersion >= 9) {
                $langs = app()->langPath();
            }
            $messages = $app['config']->get('localization-js.messages');
            $generator = new LangJsGenerator($files, $langs, $messages);

            return new LangJsCommand($generator);
        });
//        $this->app->singleton(
//        // the original class
//            'vendor/brotzka/laravel-dotenv-editor/src/DotenvEditor.php',
//            // my custom class
//            'app/DotenvEditor.php'
//        );
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     \Illuminate\Pagination\Paginator::useBootstrap();
    //     Schema::defaultStringLength(191);
    //     app()->useLangPath(base_path('lang'));
    // }

    public function boot(): void
    {
        // Share mega-menu data with the front header on every front page.
        View::composer('front_web.layouts.header', function ($view) {
            $today = Carbon::now()->toDateString();

            // Level 3 data: categories
            $categories = JobCategory::withCount([
                'jobs' => function (Builder $q) use ($today) {
                    $q->whereStatus(Job::STATUS_OPEN)
                        ->where('status', '!=', Job::STATUS_DRAFT)
                        ->whereIsSuspended(Job::NOT_SUSPENDED)
                        ->whereDate('job_expiry_date', '>=', $today);
                },
            ])
                ->orderByDesc('jobs_count')
                ->take(12)
                ->get(['id', 'name']);

            // Level 3 data: locations (cities with active jobs)
            $locations = City::query()
                ->select('cities.id', 'cities.name', DB::raw('COUNT(jobs.id) as jobs_count'))
                ->join('jobs', 'jobs.city_id', '=', 'cities.id')
                ->where('jobs.status', Job::STATUS_OPEN)
                ->where('jobs.is_suspended', Job::NOT_SUSPENDED)
                ->whereDate('jobs.job_expiry_date', '>=', $today)
                ->groupBy('cities.id', 'cities.name')
                ->orderByDesc('jobs_count')
                ->take(12)
                ->get();
            

            // Level 3 data: designations
            // This project does not have a clean Position model wired in front filters,
            // so use distinct live job titles as "designations".
            $designations = Job::query()
                ->select('job_title', DB::raw('COUNT(id) as jobs_count'))
                ->whereStatus(Job::STATUS_OPEN)
                ->where('status', '!=', Job::STATUS_DRAFT)
                ->whereIsSuspended(Job::NOT_SUSPENDED)
                ->whereDate('job_expiry_date', '>=', $today)
                ->groupBy('job_title')
                ->orderByDesc('jobs_count')
                ->take(12)
                ->get();

            $view->with([
                'megaCategories' => $categories,
                'megaLocations' => $locations,
                'megaDesignations' => $designations,
            ]);
        });
    }
}
