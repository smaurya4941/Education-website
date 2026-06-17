<div class="d-md-flex d-block justify-content-between align-items-start">
    <div>
        <h1 id="candidateName" class="text-2xl font-bold text-[#1b1c1c] font-['Plus_Jakarta_Sans'] mb-2">{{ $user->full_name }}</h1>
        <div class="mt-2 flex flex-col gap-1">
            @isset($user->candidate->full_location)
                <p class="mb-0 text-[#807287] flex items-center text-sm" id="candidateLocation">
                    <i class="fas fa-map-marker-alt w-5 text-center text-[#a100ff] mr-1"></i> {{ $user->candidate->full_location}}
                </p>
            @endisset
            <p class="mb-0 text-[#807287] flex items-center text-sm" id="cadidateEmail">
                <i class="fas fa-envelope w-5 text-center text-[#a100ff] mr-1"></i> {{ $user->email}}
            </p>
            <p id="candidatePhone" class="mb-0 text-[#807287] flex items-center text-sm">
                <i class="fas fa-phone w-5 text-center text-[#a100ff] mr-1"></i> {{ $user->phone}}
            </p>
        </div>
    </div>
    <a href="javascript:void(0)" class="editGeneralBtn w-10 h-10 flex items-center justify-center rounded-lg bg-[#faf7ff] text-[#a100ff] hover:bg-[#a100ff] hover:text-white transition-all duration-300 border border-[#e1b6ff]">
        <i class="fas fa-user-edit"></i>
    </a>
</div>

<div class="border-b border-[#ede8f5] my-6 pb-4 d-flex justify-content-between align-items-center">
    <h5 class="text-xl font-bold text-[#1b1c1c] font-['Plus_Jakarta_Sans'] m-0 flex items-center">
        <span class="w-10 h-10 rounded-full bg-[#faf7ff] text-[#a100ff] flex items-center justify-center mr-3 border border-[#e1b6ff]">
            <i class="fas fa-list-ul"></i>
        </span>
        {{ __('messages.candidate.candidate_skill') }}
    </h5>
</div>

<div id="candidateSkillDiv" class="px-2">
    @if($user->candidateSkill)
        <div class="flex flex-wrap gap-2">
            @foreach($user->candidateSkill as $skill)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-[#faf7ff] text-[#a100ff] border border-[#e1b6ff]">
                    {{ $skill->name }}
                </span>
            @endforeach
        </div>
    @endif
</div>
