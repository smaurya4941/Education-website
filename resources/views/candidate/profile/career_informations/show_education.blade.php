@foreach($data['candidateEducations'] as $candidateEducation)
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-education bg-[#faf7ff] border border-[#e1b6ff] rounded-[16px] p-5 mb-5 transition-all duration-300 hover:shadow-[0_4px_12px_rgba(161,0,255,0.08)]"
         data-education-id="{{ $loop->index }}"
         data-id="{{ $candidateEducation->id }}">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h5 class="education-degree-level text-[18px] font-bold text-[#1b1c1c] font-['Plus_Jakarta_Sans'] mb-1">{{ $candidateEducation->degreeLevel->name }}</h5>
                <h6 class="text-[#807287] font-semibold text-[15px] mb-3">{{ $candidateEducation->degree_title }}</h6>
                <div class="flex flex-col gap-1 text-[14px]">
                    <span class="text-[#4e4256] flex items-center"><i class="fas fa-calendar-alt w-5 text-center text-[#a100ff] mr-2"></i> {{ $candidateEducation->year }} | {{ $candidateEducation->country }}</span>
                    <p class="mb-0 text-[#4e4256] flex items-center"><i class="fas fa-university w-5 text-center text-[#a100ff] mr-2"></i> {{ Str::limit($candidateEducation->institute,50,'...') }}</p>
                </div>
            </div>
            <div class="flex gap-2 candidate-education-edit-delete">
                <a href="javascript:void(0)"
                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-white text-[#a100ff] border border-[#ede8f5] hover:bg-[#a100ff] hover:text-white transition-all duration-300 edit-education"
                   title="{{__('messages.common.edit')}}"
                   data-id="{{ $candidateEducation->id }}" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-pen-to-square text-[13px]"></i>
                </a>
                <a href="javascript:void(0)"
                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-white text-[#ba1a1a] border border-[#ede8f5] hover:bg-[#ba1a1a] hover:text-white transition-all duration-300 delete-education"
                   title="{{__('messages.common.delete')}}" data-bs-toggle="tooltip"
                   data-id="{{ $candidateEducation->id }}">
                    <i class="fa-solid fa-trash text-[13px]"></i>
                </a>
            </div>
        </div>
    </div>
@endforeach
