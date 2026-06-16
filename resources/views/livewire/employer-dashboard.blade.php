<div class="w-full">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        {{-- Total Jobs --}}
        <a href="{{ route('job.index') }}" class="group block no-underline transition-all duration-300 hover:-translate-y-1">
            <div class="bg-white border border-[#ede8f5] rounded-[24px] p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_32px_rgba(161,0,255,0.12)] hover:border-[#e1b6ff] transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <div class="w-[60px] h-[60px] rounded-2xl bg-[#faf7ff] flex items-center justify-center text-[#a100ff] group-hover:bg-[#a100ff] group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-[32px]">work</span>
                    </div>
                    <div>
                        <span class="block text-[11px] font-bold text-[#807287] uppercase tracking-[0.1em] font-['Plus_Jakarta_Sans']">{{ __('messages.employer_menu.total_jobs') }}</span>
                        <h2 class="text-3xl font-extrabold text-[#1b1c1c] mt-1.5 font-['Plus_Jakarta_Sans'] leading-none">
                            {{ isset($data['totalJobs']) ? numberFormatShort($data['totalJobs']) : '0' }}
                        </h2>
                    </div>
                </div>
                <span class="material-symbols-outlined text-[#d1c1d8] group-hover:text-[#a100ff] group-hover:translate-x-1 transition-all duration-300">arrow_forward</span>
            </div>
        </a>

        {{-- Live Jobs --}}
        <a href="{{ route('job.index') }}" class="group block no-underline transition-all duration-300 hover:-translate-y-1">
            <div class="bg-white border border-[#ede8f5] rounded-[24px] p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_32px_rgba(16,185,129,0.12)] hover:border-emerald-200 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <div class="w-[60px] h-[60px] rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-500 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-[32px]">sensors</span>
                    </div>
                    <div>
                        <span class="block text-[11px] font-bold text-[#807287] uppercase tracking-[0.1em] font-['Plus_Jakarta_Sans']">{{ __('messages.employer_menu.live_jobs') }}</span>
                        <h2 class="text-3xl font-extrabold text-[#1b1c1c] mt-1.5 font-['Plus_Jakarta_Sans'] leading-none">
                            {{ isset($data['jobCount']) ? numberFormatShort($data['jobCount']) : '0' }}
                        </h2>
                    </div>
                </div>
                <span class="material-symbols-outlined text-[#d1c1d8] group-hover:text-emerald-500 group-hover:translate-x-1 transition-all duration-300">arrow_forward</span>
            </div>
        </a>

        {{-- Paused Jobs --}}
        <a href="{{ route('job.index') }}" class="group block no-underline transition-all duration-300 hover:-translate-y-1">
            <div class="bg-white border border-[#ede8f5] rounded-[24px] p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_32px_rgba(245,158,11,0.12)] hover:border-amber-200 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <div class="w-[60px] h-[60px] rounded-2xl bg-amber-50 flex items-center justify-center text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-[32px]">pause_circle</span>
                    </div>
                    <div>
                        <span class="block text-[11px] font-bold text-[#807287] uppercase tracking-[0.1em] font-['Plus_Jakarta_Sans']">{{ __('messages.employer_menu.paused_jobs') }}</span>
                        <h2 class="text-3xl font-extrabold text-[#1b1c1c] mt-1.5 font-['Plus_Jakarta_Sans'] leading-none">
                            {{ isset($data['pausedJobCount']) ? numberFormatShort($data['pausedJobCount']) : '0' }}
                        </h2>
                    </div>
                </div>
                <span class="material-symbols-outlined text-[#d1c1d8] group-hover:text-amber-500 group-hover:translate-x-1 transition-all duration-300">arrow_forward</span>
            </div>
        </a>

        {{-- Closed Jobs --}}
        <div class="group block transition-all duration-300 hover:-translate-y-1">
            <div class="bg-white border border-[#ede8f5] rounded-[24px] p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_32px_rgba(225,29,72,0.12)] hover:border-rose-200 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <div class="w-[60px] h-[60px] rounded-2xl bg-rose-50 flex items-center justify-center text-rose-500 group-hover:bg-rose-500 group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-[32px]">cancel</span>
                    </div>
                    <div>
                        <span class="block text-[11px] font-bold text-[#807287] uppercase tracking-[0.1em] font-['Plus_Jakarta_Sans']">{{ __('messages.employer_menu.closed_jobs') }}</span>
                        <h2 class="text-3xl font-extrabold text-[#1b1c1c] mt-1.5 font-['Plus_Jakarta_Sans'] leading-none">
                            {{ isset($data['closedJobCount']) ? numberFormatShort($data['closedJobCount']) : '0' }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Followers --}}
        <a href="{{ route('followers.index') }}" class="group block no-underline transition-all duration-300 hover:-translate-y-1">
            <div class="bg-white border border-[#ede8f5] rounded-[24px] p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_32px_rgba(59,130,246,0.12)] hover:border-blue-200 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <div class="w-[60px] h-[60px] rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-[32px]">group</span>
                    </div>
                    <div>
                        <span class="block text-[11px] font-bold text-[#807287] uppercase tracking-[0.1em] font-['Plus_Jakarta_Sans']">{{ __('messages.employer_menu.followers') }}</span>
                        <h2 class="text-3xl font-extrabold text-[#1b1c1c] mt-1.5 font-['Plus_Jakarta_Sans'] leading-none">
                            {{ isset($data['followersCount']) ? numberFormatShort($data['followersCount']) : '0' }}
                        </h2>
                    </div>
                </div>
                <span class="material-symbols-outlined text-[#d1c1d8] group-hover:text-blue-500 group-hover:translate-x-1 transition-all duration-300">arrow_forward</span>
            </div>
        </a>

        {{-- Total Applications --}}
        <div class="group block transition-all duration-300 hover:-translate-y-1">
            <div class="bg-white border border-[#ede8f5] rounded-[24px] p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_32px_rgba(100,116,139,0.12)] hover:border-slate-200 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <div class="w-[60px] h-[60px] rounded-2xl bg-slate-50 flex items-center justify-center text-slate-500 group-hover:bg-slate-500 group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-[32px]">description</span>
                    </div>
                    <div>
                        <span class="block text-[11px] font-bold text-[#807287] uppercase tracking-[0.1em] font-['Plus_Jakarta_Sans']">{{ __('messages.employer_menu.total_job_applications') }}</span>
                        <h2 class="text-3xl font-extrabold text-[#1b1c1c] mt-1.5 font-['Plus_Jakarta_Sans'] leading-none">
                            {{ isset($data['jobApplicationsCount']) ? numberFormatShort($data['jobApplicationsCount']) : '0' }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
