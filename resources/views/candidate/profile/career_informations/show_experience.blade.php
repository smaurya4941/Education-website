@foreach($data['candidateExperiences'] as $candidateExperience)
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-experience bg-[#faf7ff] border border-[#e1b6ff] rounded-[16px] p-5 mb-5 transition-all duration-300 hover:shadow-[0_4px_12px_rgba(161,0,255,0.08)]"
         data-experience-id="{{ $loop->index }}"
         data-id="{{ $candidateExperience->id }}">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h5 class="experience-title text-[18px] font-bold text-[#1b1c1c] font-['Plus_Jakarta_Sans'] mb-1">{{ Str::limit($candidateExperience->experience_title,50,'...') }}</h5>
                <h6 class="text-[#807287] font-semibold text-[15px] mb-3">{{ $candidateExperience->company }}</h6>
                <div class="flex flex-col gap-1 text-[14px]">
                    <span class="text-[#4e4256] flex items-center">
                        <i class="fas fa-calendar-alt w-5 text-center text-[#a100ff] mr-2"></i> 
                        {{ \Carbon\Carbon::parse($candidateExperience->start_date)->translatedFormat('jS M, Y')}} - 
                        {{ ($candidateExperience->currently_working) ? __('messages.candidate_profile.present') : \Carbon\Carbon::parse($candidateExperience->end_date)->translatedFormat('jS M, Y') }}
                        <span class="mx-2">|</span> {{ $candidateExperience->country }}
                    </span>
                    @if(!empty($candidateExperience->description))
                        <p class="mt-2 mb-0 text-[#4e4256] text-[13.5px] leading-relaxed">{{ Str::limit($candidateExperience->description,225,'...') }}</p>
                    @endif
                </div>
            </div>
            <div class="flex gap-2 candidate-experience-edit-delete">
                <a href="javascript:void(0)"
                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-white text-[#a100ff] border border-[#ede8f5] hover:bg-[#a100ff] hover:text-white transition-all duration-300 edit-experience"
                   title="{{__('messages.common.edit')}}" data-bs-toggle="tooltip"
                   data-id="{{ $candidateExperience->id }}">
                    <i class="fa-solid fa-pen-to-square text-[13px]"></i>
                </a>
                <a href="javascript:void(0)"
                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-white text-[#ba1a1a] border border-[#ede8f5] hover:bg-[#ba1a1a] hover:text-white transition-all duration-300 delete-experience"
                   title="{{__('messages.common.delete')}}" data-bs-toggle="tooltip"
                   data-id="{{ $candidateExperience->id }}">
                    <i class="fa-solid fa-trash text-[13px]"></i>
                </a>
            </div>
        </div>
    </div>
@endforeach
