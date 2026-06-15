<div class="w-full">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        {{-- Total Jobs --}}
        <a href="{{ route('job.index') }}" class="group block no-underline transition-all duration-300 hover:-translate-y-1">
            <div class="bg-white border border-purple-100 rounded-xl p-6 shadow-sm group-hover:shadow-md group-hover:border-purple-200 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-lg bg-purple-50 flex items-center justify-center text-[#a100ff] group-hover:bg-[#a100ff] group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-3xl">work</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('messages.employer_menu.total_jobs') }}</span>
                        <h2 class="text-3xl font-extrabold text-gray-900 mt-1">
                            {{ isset($data['totalJobs']) ? numberFormatShort($data['totalJobs']) : '0' }}
                        </h2>
                    </div>
                </div>
                <span class="material-symbols-outlined text-gray-400 group-hover:text-[#a100ff] group-hover:translate-x-1 transition-all duration-300">arrow_forward</span>
            </div>
        </a>

        {{-- Live Jobs --}}
        <a href="{{ route('job.index') }}" class="group block no-underline transition-all duration-300 hover:-translate-y-1">
            <div class="bg-white border border-green-100 rounded-xl p-6 shadow-sm group-hover:shadow-md group-hover:border-green-200 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-lg bg-green-50 flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-3xl">sensors</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('messages.employer_menu.live_jobs') }}</span>
                        <h2 class="text-3xl font-extrabold text-gray-900 mt-1">
                            {{ isset($data['jobCount']) ? numberFormatShort($data['jobCount']) : '0' }}
                        </h2>
                    </div>
                </div>
                <span class="material-symbols-outlined text-gray-400 group-hover:text-green-600 group-hover:translate-x-1 transition-all duration-300">arrow_forward</span>
            </div>
        </a>

        {{-- Paused Jobs --}}
        <a href="{{ route('job.index') }}" class="group block no-underline transition-all duration-300 hover:-translate-y-1">
            <div class="bg-white border border-amber-100 rounded-xl p-6 shadow-sm group-hover:shadow-md group-hover:border-amber-200 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-3xl">pause_circle</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('messages.employer_menu.paused_jobs') }}</span>
                        <h2 class="text-3xl font-extrabold text-gray-900 mt-1">
                            {{ isset($data['pausedJobCount']) ? numberFormatShort($data['pausedJobCount']) : '0' }}
                        </h2>
                    </div>
                </div>
                <span class="material-symbols-outlined text-gray-400 group-hover:text-amber-600 group-hover:translate-x-1 transition-all duration-300">arrow_forward</span>
            </div>
        </a>

        {{-- Closed Jobs --}}
        <div class="group block transition-all duration-300 hover:-translate-y-1">
            <div class="bg-white border border-red-100 rounded-xl p-6 shadow-sm group-hover:shadow-md group-hover:border-red-200 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-lg bg-red-50 flex items-center justify-center text-red-600 group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-3xl">cancel</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('messages.employer_menu.closed_jobs') }}</span>
                        <h2 class="text-3xl font-extrabold text-gray-900 mt-1">
                            {{ isset($data['closedJobCount']) ? numberFormatShort($data['closedJobCount']) : '0' }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Followers --}}
        <a href="{{ route('followers.index') }}" class="group block no-underline transition-all duration-300 hover:-translate-y-1">
            <div class="bg-white border border-blue-100 rounded-xl p-6 shadow-sm group-hover:shadow-md group-hover:border-blue-200 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-3xl">group</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('messages.employer_menu.followers') }}</span>
                        <h2 class="text-3xl font-extrabold text-gray-900 mt-1">
                            {{ isset($data['followersCount']) ? numberFormatShort($data['followersCount']) : '0' }}
                        </h2>
                    </div>
                </div>
                <span class="material-symbols-outlined text-gray-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all duration-300">arrow_forward</span>
            </div>
        </a>

        {{-- Total Applications --}}
        <div class="group block transition-all duration-300 hover:-translate-y-1">
            <div class="bg-white border border-slate-100 rounded-xl p-6 shadow-sm group-hover:shadow-md group-hover:border-slate-200 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-lg bg-slate-50 flex items-center justify-center text-slate-600 group-hover:bg-slate-600 group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-3xl">description</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('messages.employer_menu.total_job_applications') }}</span>
                        <h2 class="text-3xl font-extrabold text-gray-900 mt-1">
                            {{ isset($data['jobApplicationsCount']) ? numberFormatShort($data['jobApplicationsCount']) : '0' }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
