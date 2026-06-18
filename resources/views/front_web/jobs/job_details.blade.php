@extends('front_web.layouts.app')
@section('title')
    {{ __('web.job_details.job_details') }} | {{ html_entity_decode(Str::limit($job->job_title, 50, '...')) }}
@endsection
@section('page_css')
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                fontFamily: {
                    sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    inter: ['"Inter"', 'sans-serif'],
                },
                colors: {
                    primary: '#6b21a8',
                    secondary: '#374151',
                    'brand-purple': '#581c87', /* Darker purple for title */
                    'brand-btn': '#7e22ce', /* Button purple */
                    'brand-light-purple': '#f3e8ff',
                    'brand-gray': '#f4f4f5',
                    'brand-green': '#4d7c0f',
                    'brand-sage': '#e5e7eb',
                }
            }
        }
    }
</script>
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    
    .custom-prose ul {
        list-style: none;
        padding-left: 0;
    }
    .custom-prose ul li {
        position: relative;
        padding-left: 1.5rem;
        margin-bottom: 0.5rem;
    }
    .custom-prose ul li::before {
        content: '•';
        position: absolute;
        left: 0;
        color: #7e22ce;
        font-weight: bold;
    }
</style>
@endsection

@section('content')
<div class="job-details-page font-sans bg-white min-h-screen pb-20">
    <div class="container mx-auto px-4 mt-8 max-w-[1200px]">
        @if ($job->is_suspended || !$isActive)
        <div class="mb-6 p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 flex items-start gap-3">
            <span class="material-symbols-outlined text-amber-500">warning</span>
            <div>
                {{ __('web.job_details.job_is') }}
                @php
                    $status = \App\Models\Job::STATUS[$job->status];
                @endphp
                <strong>{{ getTranslatedData($status)[0] }}.</strong>
            </div>
        </div>
        @endif

        @if (Session::has('warning'))
        <div class="mb-6 p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 flex items-start gap-3">
            <span class="material-symbols-outlined text-amber-500">info</span>
            <div>
                {{ Session::get('warning') }}
                <a href="{{ route('candidate.profile', ['section' => 'resume']) }}" class="font-bold underline text-amber-900 ml-1">{{ __('web.job_details.click_here') }}</a> {{ __('web.job_details.to_upload_resume') }}.
            </div>
        </div>
        @endif

        <!-- Header area -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-6 lg:gap-0">
            <div class="flex flex-col items-start gap-2.5">
                <h1 class="text-[32px] md:text-[36px] font-bold text-brand-purple tracking-tight leading-none">
                    {{ html_entity_decode(Str::limit($job->job_title, 50, '...')) }}
                </h1>
                <div class="px-3 py-1 bg-brand-light-purple text-brand-purple text-[13px] font-semibold rounded-full">
                    {{ html_entity_decode($job->jobCategory->name) }}
                </div>
                <div class="flex items-center text-gray-500 gap-2 text-[14px] font-medium mt-1">
                    <span class="material-symbols-outlined text-[18px]">school</span>
                    {{ html_entity_decode($job->functionalArea->name) }}
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 w-full lg:w-auto">
                @if ($job->hide_salary == '0')
                <div class="flex items-center gap-3 px-4 py-2.5 bg-brand-gray rounded-xl border border-gray-100 w-full sm:w-auto">
                    <div class="w-9 h-9 rounded-lg bg-brand-light-purple flex items-center justify-center text-brand-purple shrink-0">
                        <span class="material-symbols-outlined text-[18px]">payments</span>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-0.5">SALARY RANGE</p>
                        <p class="text-[14px] font-bold text-gray-800">{{ $job->currency->currency_icon }} {{ numberFormatShort($job->salary_from) . ' - ' . numberFormatShort($job->salary_to) }}</p>
                    </div>
                </div>
                @endif
                
                @auth
                    @role('Candidate')
                        @if (!$isApplied && !$isJobApplicationRejected && !$isJobApplicationCompleted && !$isJobApplicationShortlisted)
                            @if ($isActive && !$job->is_suspended && \Carbon\Carbon::today()->toDateString() < $job->job_expiry_date->toDateString())
                                <button class="w-full sm:w-auto px-6 py-3 rounded-xl text-white font-bold text-[14px] transition-colors {{ $isJobDrafted ? 'bg-secondary hover:bg-gray-800' : 'bg-brand-btn hover:bg-purple-800' }} flex items-center justify-center gap-2 shadow-sm" onclick="window.location='{{ route('show.apply-job-form', $job->job_id) }}'">
                                    {{ $isJobDrafted ? __('web.job_details.edit_draft') : __('web.job_details.apply_for_job') }}
                                    <span class="material-symbols-outlined text-[18px] font-bold">arrow_forward</span>
                                </button>
                            @endif
                        @else
                            <button class="w-full sm:w-auto px-6 py-3 rounded-xl bg-green-600 text-white font-bold text-[14px] cursor-default flex items-center justify-center gap-2 shadow-sm">
                                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                {{ __('web.job_details.already_applied') }}
                            </button>
                        @endif
                    @endrole
                @else
                    @if ($isActive && !$job->is_suspended && \Carbon\Carbon::today()->toDateString() < $job->job_expiry_date->toDateString())
                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <button class="w-full sm:w-auto px-5 py-3 rounded-xl bg-white border border-gray-200 text-gray-700 font-bold text-[14px] hover:border-brand-btn hover:text-brand-btn transition-colors shadow-sm" onclick="window.location='{{ route('candidate.register') }}'">
                                Register to apply
                            </button>
                            <button class="w-full sm:w-auto px-6 py-3 rounded-xl bg-brand-btn hover:bg-purple-800 text-white font-bold text-[14px] transition-colors flex items-center justify-center gap-2 shadow-sm" onclick="window.location='{{ route('front.candidate.login') }}'">
                                Apply For Job
                                <span class="material-symbols-outlined text-[18px] font-bold">arrow_forward</span>
                            </button>
                        </div>
                    @endif
                @endauth
            </div>
        </div>

        <hr class="border-gray-200 mb-5">

        <div class="flex flex-wrap items-center text-[13px] text-gray-500 font-medium mb-10 gap-6">
            <div class="flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">schedule</span>
                Posted {{ $job->created_at->diffForHumans() }}
            </div>
            <div class="flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">visibility</span>
                {{ $job->appliedJobs->count() }} Applicants
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-10">
                <!-- Job Description -->
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-1.5 h-5 bg-brand-purple rounded-full"></div>
                        <h3 class="text-[18px] font-bold text-gray-800 leading-none">
                            @lang('web.web_jobs.job_description')
                        </h3>
                    </div>
                    <div class="bg-[#fcfcfc] border border-gray-100 rounded-2xl p-7">
                        <div class="custom-prose max-w-none text-gray-600 font-inter text-[14px] leading-relaxed">
                            @if ($job->description)
                                {!! nl2br($job->description) !!}
                            @else
                                <p class="italic text-gray-400">{{ __('messages.n/a') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Key Responsibilities -->
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-1.5 h-5 bg-brand-green rounded-full"></div>
                        <h3 class="text-[18px] font-bold text-gray-800 leading-none">
                            @lang('web.web_jobs.key_responsibilities')
                        </h3>
                    </div>
                    @if ($job->key_responsibilities)
                        <div class="bg-[#fcfcfc] border border-gray-100 rounded-2xl p-7">
                            <div class="custom-prose max-w-none text-gray-600 font-inter text-[14px] leading-relaxed">
                                {!! nl2br($job->key_responsibilities) !!}
                            </div>
                        </div>
                    @else
                        <p class="italic text-gray-400 pl-4">{{ __('messages.n/a') }}</p>
                    @endif
                </div>

                <!-- Skills & Experience -->
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-1.5 h-5 bg-[#3b82f6] rounded-full"></div>
                        <h3 class="text-[18px] font-bold text-gray-800 leading-none">
                            @lang('web.web_jobs.Skill_Experience')
                        </h3>
                    </div>
                    @if (!empty($skills))
                    <div class="flex flex-wrap gap-3">
                        @php $colors = ['bg-purple-50 text-purple-700 border-purple-200', 'bg-blue-50 text-blue-700 border-blue-200', 'bg-[#ecfdf5] text-green-700 border-green-200']; @endphp
                        @foreach ($skills as $id => $skill)
                        @php $colorClass = $colors[$loop->index % count($colors)]; @endphp
                        <div class="px-4 py-2 rounded-full font-medium text-[13px] flex items-center gap-2 border {{ $colorClass }}">
                            <span class="material-symbols-outlined text-[16px]">check_circle</span>
                            {{ $skill }}
                        </div>
                        @endforeach
                    </div>
                    @else
                        <p class="italic text-gray-400 pl-4">{{ __('messages.n/a') }}</p>
                    @endif
                </div>

                <!-- Footer Share -->
                <div class="flex flex-wrap items-center mt-6 pt-6 border-t border-gray-100 gap-4">
                    <span class="text-[11px] font-bold text-gray-500 uppercase tracking-widest">SHARE THIS JOB:</span>
                    
                    <div class="flex items-center gap-2 ml-auto">
                        <button type="button" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 flex items-center justify-center transition-colors emailJobToFriend" data-bs-toggle="modal" data-bs-target="#emailJobToFriendModal" title="@lang('web.job_details.email_to_friend')">
                            <i class="fa-solid fa-share-nodes text-[13px]"></i>
                        </button>
                        <a href="https://www.linkedin.com/shareArticle/?url={{ rawurlencode(URL::to('/job-details/' . $job->job_id)) }}" target="_blank" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 flex items-center justify-center transition-colors" title="@lang('web.web_jobs.linkedin')">
                            <i class="fa-brands fa-linkedin-in text-[13px]"></i>
                        </a>
                        @auth
                            @role('Candidate')
                                @if (!$isJobReportedAsAbuse)
                                <button type="button" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-red-500 flex items-center justify-center transition-colors reportJobAbuse" data-bs-toggle="modal" data-bs-target="#reportJobAbuseModal" title="@lang('web.job_details.report_abuse')">
                                    <span class="material-symbols-outlined text-[15px]">flag</span>
                                </button>
                                @endif
                                @if (!$isJobApplicationRejected)
                                <button type="button" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-brand-btn flex items-center justify-center transition-colors" data-favorite-user-id="{{ getLoggedInUserId() !== null ? getLoggedInUserId() : null }}" data-favorite-job-id="{{ $job->id }}" id="addToFavourite" title="{{ $isJobAddedToFavourite ? __('web.job_details.remove_from_favorite') : __('web.job_details.add_to_favorite') }}">
                                    <span id="favorite" class="flex items-center justify-center">
                                        <i class=" {{ $isJobAddedToFavourite ? 'fa-solid fa-bookmark' : 'fa-regular fa-bookmark' }} text-[13px]"></i>
                                    </span>
                                </button>
                                @endif
                            @endrole
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Right Column Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Job Overview -->
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <h4 class="text-[16px] font-bold text-gray-800 mb-6">Job Overview</h4>
                    <div class="space-y-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-start gap-2.5 text-brand-purple">
                                <span class="material-symbols-outlined text-[18px] shrink-0 mt-0.5">calendar_today</span>
                                <span class="text-[12.5px] font-medium text-gray-500">Date Posted</span>
                            </div>
                            <span class="text-[12.5px] text-gray-800 font-medium text-right shrink-0 break-words">
                                {{ \Carbon\Carbon::parse($job->created_at)->translatedFormat('jS M, Y') }}
                            </span>
                        </div>
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-start gap-2.5 text-brand-purple">
                                <span class="material-symbols-outlined text-[18px] shrink-0 mt-0.5">hourglass_disabled</span>
                                <span class="text-[12.5px] font-medium text-gray-500">Expiration date</span>
                            </div>
                            <span class="text-[12.5px] text-gray-800 font-medium text-right shrink-0 break-words">
                                {{ \Carbon\Carbon::parse($job->job_expiry_date)->translatedFormat('jS M, Y') }}
                            </span>
                        </div>
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-start gap-2.5 text-brand-purple">
                                <span class="material-symbols-outlined text-[18px] shrink-0 mt-0.5">location_on</span>
                                <span class="text-[12.5px] font-medium text-gray-500">Location</span>
                            </div>
                            <span class="text-[12.5px] text-gray-800 font-medium text-right text-balance leading-snug break-words">
                                @if (!empty($job->city_id)) {{ $job->city_name }}, @endif
                                @if (!empty($job->state_id)) {{ $job->state_name }}, @endif
                                @if (!empty($job->country_id)) {{ $job->country_name }} @endif
                                @if (empty($job->country_id)) <span class="italic text-gray-400 font-normal">{{ __('web.job_details.location_information_not_available') }}</span> @endif
                            </span>
                        </div>
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-start gap-2.5 text-brand-purple">
                                <span class="material-symbols-outlined text-[18px] shrink-0 mt-0.5">work_outline</span>
                                <span class="text-[12.5px] font-medium text-gray-500">Employment Type</span>
                            </div>
                            <span class="text-[12.5px] text-gray-800 font-medium text-right shrink-0 leading-snug break-words">
                                {{ $job->jobType ? html_entity_decode($job->jobType->name) : __('messages.n/a') }}
                            </span>
                        </div>
                        @if ($job->jobShift)
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-start gap-2.5 text-brand-purple">
                                <span class="material-symbols-outlined text-[18px] shrink-0 mt-0.5">schedule</span>
                                <span class="text-[12.5px] font-medium text-gray-500">Work Schedule</span>
                            </div>
                            <span class="text-[12.5px] text-gray-800 font-medium text-right shrink-0 leading-snug break-words">
                                {{ html_entity_decode($job->jobShift->shift) }}
                            </span>
                        </div>
                        @endif
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-start gap-2.5 text-brand-purple">
                                <span class="material-symbols-outlined text-[18px] shrink-0 mt-0.5">verified</span>
                                <span class="text-[12.5px] font-medium text-gray-500">Minimum Job Experience Required(in years)</span>
                            </div>
                            <span class="text-[12.5px] text-gray-800 font-medium text-right shrink-0 leading-snug break-words">
                                {{ isset($job->experience) ? $job->experience . ' ' . __('messages.candidate_profile.year') : 'No experience' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Company Info -->
                <div class="bg-[#f0f1f3] rounded-xl p-6 border border-gray-200/60">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-[50px] h-[50px] bg-white rounded-lg shadow-sm flex items-center justify-center p-1.5 shrink-0">
                            <img src="{{ $job->company->company_url }}" class="w-full h-full object-contain" alt="company logo">
                        </div>
                        <div>
                            <h5 class="text-[15px] font-bold text-gray-800 leading-tight mb-0.5">{{ html_entity_decode($job->company->user->first_name) }}</h5>
                            <p class="text-[11px] text-gray-500 font-medium">{{ html_entity_decode($job->company->industry->name ?? 'Company') }}</p>
                        </div>
                    </div>

                    <div class="text-[12.5px] text-gray-600 leading-relaxed mb-6">
                        Leading institution committed to providing world-class environments and fostering excellence. 
                        @if(!empty($job->company->location)) Located in {{ $job->company->location }}. @endif
                        Founded in {{ $job->company->established_in }}.
                    </div>

                    <a href="{{ route('front.company.details', $job->company->unique_id) }}" class="block w-full text-center bg-white text-brand-purple font-semibold text-[13px] py-2.5 rounded-lg border border-gray-200 hover:bg-gray-50 transition-all mb-4">
                        View company profile
                    </a>

                    <div class="flex items-center justify-between bg-[#d9e1d5] px-4 py-3 rounded-lg">
                        <span class="text-[12px] font-medium text-gray-800">Open Positions</span>
                        <span class="text-[14px] font-bold text-gray-900">{{ $jobsCount ? $jobsCount : 0 }}</span>
                    </div>
                </div>
            </div>
        </div>

        @if (count($getRelatedJobs) > 0)
        <!-- Related Jobs section -->
        <div class="mt-16">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1.5 h-5 bg-gray-800 rounded-full"></div>
                <h3 class="text-[18px] font-bold text-gray-800 leading-none">
                    @lang('web.job_details.related_jobs')
                </h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($getRelatedJobs as $relatedJob)
                    @if ($relatedJob->status != \App\Models\Job::STATUS_DRAFT)
                    <div class="bg-white border border-gray-200 shadow-sm hover:shadow-md rounded-xl p-5 transition-all group">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-[45px] h-[45px] rounded-lg border border-gray-100 p-1 bg-white">
                                <img src="{{ $relatedJob->company->company_url }}" class="w-full h-full object-contain" alt="..." />
                            </div>
                            <div class="w-7 h-7 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:text-brand-purple transition-colors">
                                <i class="fa-solid fa-bookmark text-[12px]"></i>
                            </div>
                        </div>
                        
                        <a href="{{ route('front.job.details', $relatedJob['job_id']) }}" class="block mb-1.5">
                            <h4 class="text-[16px] font-bold text-gray-800 leading-tight group-hover:text-brand-purple transition-colors" title="{{ html_entity_decode($relatedJob['job_title']) }}">
                                {{ Str::limit(html_entity_decode($relatedJob['job_title']), 30, '...') }}
                            </h4>
                        </a>
                        
                        <a href="{{ route('front.company.details', $relatedJob->company->unique_id) }}" class="text-[13px] text-brand-purple font-medium block mb-4">
                            {{ $relatedJob->company->user->first_name }}
                        </a>
                        
                        <div class="space-y-1.5 mt-auto">
                            <div class="flex items-center gap-2 text-[13px] text-gray-500">
                                <span class="material-symbols-outlined text-[16px]">work</span>
                                {{ !empty($relatedJob->jobCategory->name) ? $relatedJob->jobCategory->name : '' }}
                            </div>
                            <div class="flex items-center gap-2 text-[13px] text-gray-500">
                                <span class="material-symbols-outlined text-[16px]">location_on</span>
                                <span class="truncate">{{ !empty($relatedJob->full_location) ? $relatedJob->full_location : 'Location Info. not available.' }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            
            <div class="text-center mt-10">
                <a href="{{ route('front.search.jobs', ['categories' => $job->jobCategory->id]) }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-brand-purple text-white font-medium hover:bg-purple-800 transition-colors shadow-sm">
                    @lang('web.common.show_all')
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>
        </div>
        @endif
    </div>
</div>

@role('Candidate')
    @include('front_web.jobs.email_to_friend')
    @include('front_web.jobs.report_job_modal')
@endrole
{{ Form::hidden('isJobAddedToFavourite', $isJobAddedToFavourite, ['id' => 'isJobAddedToFavourite']) }}
{{ Form::hidden('removeFromFavorite', __('web.job_details.remove_from_favorite'), ['id' => 'removeFromFavorite']) }}
{{ Form::hidden('addToFavorites', __('web.job_details.add_to_favorite'), ['id' => 'addToFavorites']) }}
@endsection
