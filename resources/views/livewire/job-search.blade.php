<div>
    <div class="flex flex-col gap-4 mb-xl">
        @forelse($jobs as $job)
            <a href="{{ route('front.job.details', $job['job_id']) }}" class="block bg-surface-container-lowest border border-outline-variant rounded-2xl p-6 job-card-hover text-decoration-none group">
                <div class="flex items-start gap-5">
                    <!-- Icon / Logo -->
                    <div class="w-16 h-16 rounded-2xl bg-primary-fixed-dim/20 flex items-center justify-center flex-shrink-0 text-primary overflow-hidden">
                        @if($job->company && $job->company->company_url)
                            <img src="{{ $job->company->company_url }}" alt="Company Logo" class="w-full h-full object-cover">
                        @else
                            <span class="material-symbols-outlined text-[32px]">work</span>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-grow">
                        <div class="flex justify-between items-start mb-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <h3 class="font-headline-md text-[20px] font-bold text-on-surface m-0 group-hover:text-primary transition-colors">
                                    {{ html_entity_decode(Str::limit($job['job_title'], 50)) }}
                                </h3>
                                @if(!empty($job->experience))
                                <span class="px-3 py-1 bg-tertiary-fixed text-tertiary-container rounded-full text-[12px] font-bold tracking-wide">
                                    {{ $job->experience }} EXP
                                </span>
                                @endif
                            </div>
                            
                            <!-- Job Type Badge -->
                            @if(isset($job->jobType))
                            <span class="px-4 py-1.5 bg-secondary-container text-on-secondary-container rounded-lg text-[13px] font-semibold whitespace-nowrap ml-3">
                                {{ $job->jobType->name }}
                            </span>
                            @endif
                        </div>

                        <p class="font-body-md text-secondary text-[15px] mb-4">
                            {{ $job->company->user->first_name ?? '' }} {{ $job->company->user->last_name ?? '' }}
                        </p>

                        <div class="flex flex-wrap gap-5 text-on-surface-variant text-[14px] mb-4">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[18px]">location_on</span>
                                {{ !empty($job->full_location) ? $job->full_location : 'Location Info. not available.' }}
                            </div>
                            @if (isset($job->jobShift->shift))
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[18px]">schedule</span>
                                {{ $job->jobShift->shift }}
                            </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1.5 text-on-surface-variant text-[14px]">
                                <span class="material-symbols-outlined text-[18px]">history</span>
                                {{ $job->created_at->diffForHumans() }}
                            </div>
                            <button class="px-6 py-2.5 bg-primary text-on-primary rounded-xl font-semibold text-[14px] shadow-sm group-hover:bg-[#8b00e6] transition-colors">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center text-on-surface-variant py-xl">
                @lang('web.job_menu.no_results_found')
            </div>
        @endforelse
    </div>

    @if($jobs->count() > 0)
        <div class="mt-lg flex justify-center w-full">
            {{ $jobs->links() }}
        </div>
    @endif
</div>
