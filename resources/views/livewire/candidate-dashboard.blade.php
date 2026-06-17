<div class="w-full">
    {{-- Candidate Profile Header --}}
    <div class="bg-white border border-[#ede8f5] rounded-[24px] p-8 shadow-[0_2px_8px_rgba(0,0,0,0.04)] mb-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
            <div class="relative w-[120px] h-[120px] rounded-[20px] overflow-hidden border-4 border-white shadow-[0_8px_24px_rgba(161,0,255,0.12)] shrink-0">
                <img src="{{ getCompanyLogo() }}" alt="Profile Image" class="w-full h-full object-cover">
            </div>
            
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-[#1b1c1c] font-['Plus_Jakarta_Sans'] tracking-tight mb-2">
                    {{ html_entity_decode($user->full_name) }}
                </h1>
                
                <div class="flex flex-wrap gap-4 text-sm font-medium text-[#807287]">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px] text-[#a100ff]">call</span>
                        <span>{{ !empty($user->phone) ? $user->phone : __('messages.candidate_dashboard.no_not_available') }}</span>
                    </div>
                    
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px] text-[#a100ff]">location_on</span>
                        <span>{{ !empty($candidate->city_name) ? $candidate->city_name . ', ' . $candidate->state_name . ', ' . $candidate->country_name : (!empty($candidate->country_id) ? $candidate->country_name : __('messages.candidate_dashboard.location_information')) }}</span>
                    </div>
                    
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px] text-[#a100ff]">mail</span>
                        <span>{{ $user->email }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="shrink-0 w-full md:w-auto">
            <a href="{{ route('candidate.profile') }}" class="inline-flex items-center justify-center w-full md:w-auto gap-2 px-6 py-3 bg-[#faf7ff] text-[#a100ff] hover:bg-[#a100ff] hover:text-white rounded-xl font-bold transition-all duration-300 font-['Plus_Jakarta_Sans'] shadow-[0_4px_12px_rgba(161,0,255,0.08)] hover:shadow-[0_8px_24px_rgba(161,0,255,0.2)]">
                <span class="material-symbols-outlined text-[20px]">edit</span>
                {{ __('messages.user.edit_profile') }}
            </a>
        </div>
    </div>

    {{-- Dashboard Widgets --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        
        {{-- Profile Views --}}
        <div class="group block transition-all duration-300 hover:-translate-y-1">
            <div class="bg-white border border-[#ede8f5] rounded-[24px] p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_32px_rgba(16,185,129,0.12)] hover:border-emerald-200 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <div class="w-[60px] h-[60px] rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-500 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-[32px]">visibility</span>
                    </div>
                    <div>
                        <span class="block text-[11px] font-bold text-[#807287] uppercase tracking-[0.1em] font-['Plus_Jakarta_Sans']">{{ __('messages.candidate_dashboard.profile_views') }}</span>
                        <h2 class="text-3xl font-extrabold text-[#1b1c1c] mt-1.5 font-['Plus_Jakarta_Sans'] leading-none">
                            {{ numberFormatShort($user->profile_views) }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Followings --}}
        <a href="{{ route('favourite.companies') }}" class="group block no-underline transition-all duration-300 hover:-translate-y-1">
            <div class="bg-white border border-[#ede8f5] rounded-[24px] p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_32px_rgba(59,130,246,0.12)] hover:border-blue-200 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <div class="w-[60px] h-[60px] rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-[32px]">business</span>
                    </div>
                    <div>
                        <span class="block text-[11px] font-bold text-[#807287] uppercase tracking-[0.1em] font-['Plus_Jakarta_Sans']">{{ __('messages.candidate_dashboard.followings') }}</span>
                        <h2 class="text-3xl font-extrabold text-[#1b1c1c] mt-1.5 font-['Plus_Jakarta_Sans'] leading-none">
                            {{ numberFormatShort($followings) }}
                        </h2>
                    </div>
                </div>
                <span class="material-symbols-outlined text-[#d1c1d8] group-hover:text-blue-500 group-hover:translate-x-1 transition-all duration-300">arrow_forward</span>
            </div>
        </a>

        {{-- Resumes / Applied Jobs --}}
        <div class="group block transition-all duration-300 hover:-translate-y-1">
            <div class="bg-white border border-[#ede8f5] rounded-[24px] p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_32px_rgba(245,158,11,0.12)] hover:border-amber-200 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <div class="w-[60px] h-[60px] rounded-2xl bg-amber-50 flex items-center justify-center text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-[32px]">description</span>
                    </div>
                    <div>
                        <span class="block text-[11px] font-bold text-[#807287] uppercase tracking-[0.1em] font-['Plus_Jakarta_Sans']">{{ __('messages.apply_job.resume') }}</span>
                        <h2 class="text-3xl font-extrabold text-[#1b1c1c] mt-1.5 font-['Plus_Jakarta_Sans'] leading-none">
                            {{ numberFormatShort($resumes) }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
