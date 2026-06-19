@extends('front_web.layouts.app')
@section('title')
    {{ __('web.job_menu.search_job') }}
@endsection

@section('page_css')
    @if (\Illuminate\Support\Facades\App::getLocale() == 'ar')
        <style>
            .job-post-wrapper ul.pagination {
                direction: rtl;
            }
        </style>
    @endif
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-fixed": "#acf852",
                        "primary-fixed": "#f1daff",
                        "background": "#f9f9fc",
                        "on-primary-fixed": "#2d004f",
                        "surface-container": "#eeeef0",
                        "on-secondary-container": "#003f7c",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#e8e8ea",
                        "surface-tint": "#8b00e6",
                        "primary-container": "#9b00ff",
                        "inverse-surface": "#2f3133",
                        "surface-dim": "#dadadc",
                        "on-secondary-fixed-variant": "#004789",
                        "surface-variant": "#e2e2e5",
                        "on-background": "#1a1c1e",
                        "error-container": "#ffdad6",
                        "on-secondary": "#ffffff",
                        "on-error": "#ffffff",
                        "on-surface": "#1a1c1e",
                        "on-tertiary-fixed-variant": "#2e4f00",
                        "on-primary": "#ffffff",
                        "on-tertiary-container": "#b7ff65",
                        "tertiary-fixed-dim": "#91da37",
                        "on-primary-fixed-variant": "#6a00b1",
                        "on-error-container": "#93000a",
                        "inverse-on-surface": "#f0f0f3",
                        "surface-container-highest": "#e2e2e5",
                        "tertiary-container": "#467600",
                        "error": "#ba1a1a",
                        "on-primary-container": "#f6e4ff",
                        "secondary": "#1a5eab",
                        "on-tertiary": "#ffffff",
                        "tertiary": "#355b00",
                        "surface-container-low": "#f3f3f6",
                        "primary-fixed-dim": "#dfb7ff",
                        "primary": "#7900c9",
                        "on-secondary-fixed": "#001b3c",
                        "secondary-fixed": "#d5e3ff",
                        "inverse-primary": "#dfb7ff",
                        "surface-bright": "#f9f9fc",
                        "surface": "#f9f9fc",
                        "outline": "#7f7287",
                        "secondary-container": "#76adff",
                        "secondary-fixed-dim": "#a7c8ff",
                        "outline-variant": "#d1c1d9",
                        "on-tertiary-fixed": "#0f2000",
                        "on-surface-variant": "#4e4356"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xl": "80px",
                        "sm": "16px",
                        "lg": "48px",
                        "md": "24px",
                        "gutter": "24px",
                        "container-max": "1280px",
                        "base": "4px",
                        "xs": "8px"
                    },
                    "fontFamily": {
                        "label-md": ["Inter"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "body-lg": ["Inter"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "body-md": ["Inter"]
                    },
                    "fontSize": {
                        "label-md": ["14px", {"lineHeight": "1.4", "fontWeight": "500"}],
                        "headline-lg": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                        "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "headline-lg-mobile": ["28px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "1.5", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
        }
        .shadow-premium {
            box-shadow: 0 10px 30px -5px rgba(32, 98, 175, 0.08);
        }
        .job-card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .job-card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -10px rgba(121, 0, 201, 0.12);
            border-color: #dfb7ff;
        }
        .find-jobs-container::-webkit-scrollbar { width: 6px; }
        .find-jobs-container::-webkit-scrollbar-track { background: transparent; }
        .find-jobs-container::-webkit-scrollbar-thumb { background: #d1c1d9; border-radius: 10px; }
    </style>
@endsection

@section('content')
<div class="find-jobs-container bg-background text-on-background font-body-md selection:bg-primary-fixed-dim selection:text-on-primary-fixed relative overflow-hidden" style="min-height: calc(100vh - 72px);">
    <!-- Floating Atmosphere Elements -->
    <div class="absolute top-20 right-[10%] w-64 h-64 bg-primary-fixed-dim/20 blur-[100px] pointer-events-none rounded-full z-0"></div>
    <div class="absolute bottom-20 left-1/2 w-96 h-96 bg-tertiary-fixed/10 blur-[120px] pointer-events-none rounded-full z-0"></div>

    <div class="flex flex-col lg:flex-row relative z-10 w-full max-w-[1440px] mx-auto">
        <!-- SideNavBar (Shared Component) -->
        <aside class="lg:w-96 lg:sticky lg:top-[72px] lg:h-[calc(100vh-72px)] overflow-y-auto bg-surface-container-low border-r border-outline-variant flex flex-col py-md gap-sm shadow-sm w-full shrink-0">
            <!-- <div class="px-md mb-lg pt-4 hidden lg:block">
                <div class="font-headline-md text-headline-md font-bold text-primary">{{ getAppName() }}</div>
                <div class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Recruitment Portal</div>
            </div> -->
            
            <form id="twSearchForm" class="px-md flex flex-col gap-sm flex-grow overflow-y-auto pb-sm pt-sm">
                <div class="flex flex-col gap-1">
                    <label class="font-label-md text-[12px] text-on-surface-variant uppercase tracking-wider px-sm mb-0">@lang('web.post_menu.categories')</label>
                    <select id="twSearchCategories" class="w-full bg-surface-container-lowest border-outline-variant rounded-lg text-[14px] text-on-surface focus:border-primary focus:ring-1 focus:ring-primary py-1.5 px-3">
                        <option value="">@lang('web.job_menu.none')</option>
                        @foreach ($jobCategories as $key => $value)
                            <option value="{{ $key }}" {{ request()->get('categories') == $key ? 'selected' : '' }}>
                                {{ html_entity_decode($value) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if ($jobSkills->isNotEmpty())
                <div class="flex flex-col gap-1">
                    <label class="font-label-md text-[12px] text-on-surface-variant uppercase tracking-wider px-sm mb-0">@lang('messages.candidate.candidate_skill')</label>
                    <select id="twSearchSkill" class="w-full bg-surface-container-lowest border-outline-variant rounded-lg text-[14px] text-on-surface focus:border-primary focus:ring-1 focus:ring-primary py-1.5 px-3">
                        <option value="">@lang('web.job_menu.none')</option>
                        @foreach ($jobSkills as $key => $value)
                            <option value="{{ $key }}">{{ html_entity_decode($value) }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="flex flex-col gap-1">
                    <label class="font-label-md text-[12px] text-on-surface-variant uppercase tracking-wider px-sm mb-0">@lang('messages.candidate.gender')</label>
                    <select id="twSearchGender" class="w-full bg-surface-container-lowest border-outline-variant rounded-lg text-[14px] text-on-surface focus:border-primary focus:ring-1 focus:ring-primary py-1.5 px-3">
                        <option value="">@lang('web.job_menu.none')</option>
                        @foreach ($genders as $key => $value)
                            <option value="{{ $key }}">{{ html_entity_decode($value) }}</option>
                        @endforeach
                    </select>
                </div>

                @if ($careerLevels->isNotEmpty())
                <div class="flex flex-col gap-1">
                    <label class="font-label-md text-[12px] text-on-surface-variant uppercase tracking-wider px-sm mb-0">@lang('messages.job.career_level')</label>
                    <select id="twSearchCareerLevel" class="w-full bg-surface-container-lowest border-outline-variant rounded-lg text-[14px] text-on-surface focus:border-primary focus:ring-1 focus:ring-primary py-1.5 px-3">
                        <option value="">@lang('web.job_menu.none')</option>
                        @foreach ($careerLevels as $key => $value)
                            <option value="{{ $key }}">{{ html_entity_decode($value) }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                @if ($functionalAreas->isNotEmpty())
                <div class="flex flex-col gap-1">
                    <label class="font-label-md text-[12px] text-on-surface-variant uppercase tracking-wider px-sm mb-0">@lang('messages.job.functional_area')</label>
                    <select id="twSearchFunctionalArea" class="w-full bg-surface-container-lowest border-outline-variant rounded-lg text-[14px] text-on-surface focus:border-primary focus:ring-1 focus:ring-primary py-1.5 px-3">
                        <option value="">@lang('web.job_menu.none')</option>
                        @foreach ($functionalAreas as $key => $value)
                            <option value="{{ $key }}">{{ html_entity_decode($value) }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                @if ($jobTypes->isNotEmpty())
                <div class="flex flex-col gap-1">
                    <label class="font-label-md text-[12px] text-on-surface-variant uppercase tracking-wider px-sm mb-0">@lang('web.job_menu.type')</label>
                    <div class="flex flex-col gap-1 px-sm">
                        @foreach ($jobTypes as $key => $jobType)
                            @if ($jobType->jobs_count > 0)
                            <label class="flex items-center gap-2 text-[14px] text-on-surface cursor-pointer">
                                <input type="checkbox" class="twJobType rounded border-outline-variant text-primary focus:ring-primary w-4 h-4" value="{{ $jobType->id }}"> 
                                {{ html_entity_decode($jobType->name) }} <span class="text-[12px] text-on-surface-variant ml-1">({{ $jobType->jobs_count }})</span>
                            </label>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="flex flex-col gap-1">
                    <label class="font-label-md text-[12px] text-on-surface-variant uppercase tracking-wider px-sm mb-0">Salary Range</label>
                    <div class="flex gap-2 px-sm">
                        <input type="number" id="twSalaryFrom" placeholder="From" class="w-1/2 bg-surface-container-lowest border-outline-variant rounded-lg text-[14px] text-on-surface focus:border-primary focus:ring-1 focus:ring-primary py-1.5 px-3">
                        <input type="number" id="twSalaryTo" placeholder="To" class="w-1/2 bg-surface-container-lowest border-outline-variant rounded-lg text-[14px] text-on-surface focus:border-primary focus:ring-1 focus:ring-primary py-1.5 px-3">
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="font-label-md text-[12px] text-on-surface-variant uppercase tracking-wider px-sm mb-0">@lang('messages.candidate.experience')</label>
                    <input type="number" id="twJobExperience" min="0" placeholder="Min Experience" class="mx-sm bg-surface-container-lowest border-outline-variant rounded-lg text-[14px] text-on-surface focus:border-primary focus:ring-1 focus:ring-primary py-1.5 px-3">
                </div>
            </form>

            <div class="mt-auto px-md pt-lg border-t border-outline-variant bg-surface-container-low sticky bottom-0 z-20">
                <button type="button" id="twMobileApplyBtn" class="w-full bg-primary text-on-primary py-sm rounded-xl font-label-md text-label-md shadow-premium hover:opacity-90 transition-opacity">Apply Filters</button>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-grow p-4 lg:p-xl max-w-[1200px] w-full mx-auto">
            <!-- Header Section -->
            <header class="mb-lg">
                <nav class="mb-xs">
                    <ol class="flex items-center gap-xs font-label-md text-label-md text-on-surface-variant list-none pl-0">
                        <li class="hover:text-primary transition-colors cursor-pointer"><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="">/</li>
                        <li class="text-primary font-bold">Jobs</li>
                    </ol>
                </nav>
                <h1 class="font-headline-lg text-headline-lg text-on-surface m-0">
                    @if (!empty($selectedCity))
                        Jobs in {{ $selectedCity->name }}
                    @else
                        @lang('web.web_jobs.find_jobs')
                    @endif
                </h1>
            </header>

            <!-- Search Bar Section -->
            <section class="mb-lg bg-surface-container-lowest p-md rounded-2xl border border-outline-variant shadow-premium flex flex-col md:flex-row gap-md items-center">
                <div class="relative flex-grow w-full">
                    <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-outline">search</span>
                    <input class="w-full pl-xl pr-md py-sm bg-surface-container-low border-transparent rounded-xl focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-on-surface placeholder:text-outline transition-all" placeholder="{{ !empty($selectedCity) ? 'Search jobs in '.$selectedCity->name : __('web.web_home.job_title_keywords_company') }}" type="text" id="twSearchByLocation" value="{{ request()->input('keywords') }}">
                </div>
                <div class="flex gap-sm w-full md:w-auto">
                    <button type="button" id="twSearchBtn" class="flex-grow md:flex-none px-lg py-sm bg-primary text-on-primary rounded-xl font-label-md text-label-md hover:shadow-lg transition-all" style="transform: scale(1);">
                        Search
                    </button>
                    <button type="button" id="twResetFilter" class="flex-grow md:flex-none px-md py-sm text-secondary font-label-md text-label-md hover:bg-secondary-container/10 rounded-xl transition-all flex items-center justify-center gap-xs" style="transform: scale(1);">
                        <span class="material-symbols-outlined text-[18px]">restart_alt</span>
                        Reset Filter
                    </button>
                </div>
            </section>

            <!-- Job Grid from Livewire -->
            @livewire('job-search')
            
        </main>
    </div>
</div>
{{ Form::hidden('jobType', json_encode($input), ['id' => 'input']) }}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Micro-interactions for button clicks
        document.querySelectorAll('button').forEach(btn => {
            btn.addEventListener('mousedown', () => {
                btn.style.transform = 'scale(0.96)';
            });
            btn.addEventListener('mouseup', () => {
                btn.style.transform = 'scale(1)';
            });
            btn.addEventListener('mouseleave', () => {
                btn.style.transform = 'scale(1)';
            });
        });

        // Search Input focus effect
        const searchInput = document.getElementById('twSearchByLocation');
        if(searchInput) {
            searchInput.addEventListener('focus', () => {
                searchInput.parentElement.classList.add('ring-2', 'ring-primary/20');
            });
            searchInput.addEventListener('blur', () => {
                searchInput.parentElement.classList.remove('ring-2', 'ring-primary/20');
            });
        }
        
        // Dispatch to Livewire
        const dispatchToLivewire = (param, value) => {
            if(window.Livewire) {
                Livewire.dispatch('changeFilter', { param: param, value: value });
            }
        };

        // Wire inputs
        document.getElementById('twSearchCategories')?.addEventListener('change', e => dispatchToLivewire('category', e.target.value));
        document.getElementById('twSearchSkill')?.addEventListener('change', e => dispatchToLivewire('skill', e.target.value));
        document.getElementById('twSearchGender')?.addEventListener('change', e => dispatchToLivewire('gender', e.target.value));
        document.getElementById('twSearchCareerLevel')?.addEventListener('change', e => dispatchToLivewire('careerLevel', e.target.value));
        document.getElementById('twSearchFunctionalArea')?.addEventListener('change', e => dispatchToLivewire('functionalArea', e.target.value));
        
        document.querySelectorAll('.twJobType').forEach(cb => {
            cb.addEventListener('change', () => {
                let selectedTypes = Array.from(document.querySelectorAll('.twJobType:checked')).map(el => el.value);
                dispatchToLivewire('types', selectedTypes);
            });
        });

        let searchTimeout;
        searchInput?.addEventListener('keyup', e => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                dispatchToLivewire('searchByLocation', e.target.value);
            }, 300);
        });
        
        document.getElementById('twSearchBtn')?.addEventListener('click', () => {
            dispatchToLivewire('searchByLocation', searchInput.value);
        });

        document.getElementById('twSalaryFrom')?.addEventListener('change', e => dispatchToLivewire('salaryFrom', e.target.value));
        document.getElementById('twSalaryTo')?.addEventListener('change', e => dispatchToLivewire('salaryTo', e.target.value));
        document.getElementById('twJobExperience')?.addEventListener('change', e => dispatchToLivewire('jobExperience', e.target.value));

        // Reset
        document.getElementById('twResetFilter')?.addEventListener('click', e => {
            e.preventDefault();
            if(window.Livewire) {
                Livewire.dispatch('resetFilter');
            }
            document.getElementById('twSearchForm').reset();
            searchInput.value = '';
        });
        
        // If keyword from request
        let initialKeyword = "{{ request()->input('keywords') }}";
        if (initialKeyword && window.Livewire) {
             Livewire.dispatch('changeFilter', { param: 'title', value: initialKeyword });
        }
    });
</script>
@endsection

