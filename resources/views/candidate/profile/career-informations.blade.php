@extends('candidate.profile.index')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css') }}">
@endpush
@section('section')
<div class="bg-white border border-[#ede8f5] rounded-[24px] shadow-[0_4px_20px_rgba(161,0,255,0.06)] p-6 lg:p-8 mb-8">
    <div class="mb-xl-8">
        <div class="border-0">
            <div class="d-md-flex align-items-center justify-content-between mb-5">
                <h1 class="text-2xl font-extrabold text-[#1b1c1c] tracking-tight font-['Plus_Jakarta_Sans']">{{ __('messages.candidate_profile.experience') }}</h1>
                <div class="text-end mt-4 mt-md-0">
                    <a class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-[14px] font-bold rounded-xl text-white bg-[#a100ff] hover:bg-[#8e00e2] shadow-[0_4px_12px_rgba(161,0,255,0.2)] transition-all duration-300 font-['Plus_Jakarta_Sans'] cursor-pointer addExperienceModal" data-bs-toggle="modal"
                        data-bs-target="#addExperienceModal">{{ __('messages.candidate_profile.add_experience') }} </a>
                </div>
            </div>

            <div class="pt-0 py-4 text-gray-700">
                {{ Form::hidden(null, __('messages.candidate_profile.present'), ['id' => 'candidatePresentMsg']) }}
                <div class="row">
                    <div class="candidate-experience-container w-full grid grid-cols-1 gap-6">
                        <div class="col-12 {{ $data['candidateExperiences']->count() ? 'd-none' : '' }}"
                            id="notfoundExperience">
                            <div class="bg-[#faf7ff] border border-[#e1b6ff] rounded-[16px] p-8 text-center">
                                <h5 class="text-[#807287] font-medium font-['Plus_Jakarta_Sans']">
                                    {{ __('messages.candidate.experience_not_found') }}
                                </h5>
                            </div>
                        </div>
                        @php
                            /** @var \App\Models\CandidateExperience $candidateExperience */
                        @endphp
                        @foreach ($data['candidateExperiences'] as $candidateExperience)
                            <div class="col-12 candidate-experience bg-white border border-[#ede8f5] rounded-[16px] shadow-[0_2px_8px_rgba(0,0,0,0.04)] p-6 transition-all duration-300 hover:shadow-[0_8px_24px_rgba(161,0,255,0.08)] hover:border-[#e1b6ff] relative group"
                                data-experience-id="{{ $loop->index }}" data-id="{{ $candidateExperience->id }}">
                                <article class="article article-style-b w-full">
                                    <div class="article-details">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div class="article-title">
                                                <h4 class="text-[18px] font-bold text-[#1b1c1c] font-['Plus_Jakarta_Sans'] mb-1">{{ $candidateExperience->experience_title }}</h4>
                                                <h6 class="text-[15px] font-semibold text-[#a100ff] font-['Plus_Jakarta_Sans']">{{ $candidateExperience->company }}</h6>
                                            </div>
                                            <div class="article-cta candidate-experience-edit-delete flex gap-2">
                                                <a href="javascript:void(0)"
                                                    class="edit-candidate-experience w-8 h-8 rounded-lg bg-[#faf7ff] text-[#a100ff] border border-[#ede8f5] hover:bg-[#a100ff] hover:text-white flex items-center justify-center transition-all duration-200"
                                                    title="{{ __('messages.common.edit') }}" data-bs-toggle="tooltip"
                                                    data-id="{{ $candidateExperience->id }}"><span class="material-symbols-outlined text-[18px]">edit</span></a>
                                                <a href="javascript:void(0)"
                                                    class="delete-experience w-8 h-8 rounded-lg bg-red-50 text-red-500 border border-red-100 hover:bg-red-500 hover:text-white flex items-center justify-center transition-all duration-200"
                                                    title="{{ __('messages.common.delete') }}" data-bs-toggle="tooltip"
                                                    data-id="{{ $candidateExperience->id }}"><span class="material-symbols-outlined text-[18px]">delete</span></a>
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-wrap items-center gap-3 text-[14px] text-[#807287] font-medium mb-3">
                                            <div class="flex items-center gap-1.5 bg-gray-50 px-3 py-1 rounded-full">
                                                <span class="material-symbols-outlined text-[16px]">calendar_month</span>
                                                <span>{{ \Carbon\Carbon::parse($candidateExperience->start_date)->translatedFormat('jS M, Y') }} - 
                                                @if ($candidateExperience->currently_working)
                                                    {{ __('messages.candidate_profile.present') }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($candidateExperience->end_date)->translatedFormat('jS M, Y') }}
                                                @endif
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-1.5 bg-gray-50 px-3 py-1 rounded-full">
                                                <span class="material-symbols-outlined text-[16px]">public</span>
                                                <span>{{ $candidateExperience->country }}</span>
                                            </div>
                                        </div>
                                        
                                        @if (!empty($candidateExperience->description))
                                            <p class="text-[14px] text-[#4e4256] leading-relaxed mb-0">
                                                {{ Str::limit($candidateExperience->description, 225, '...') }}</p>
                                        @endif
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-[#ede8f5] pt-8 mt-4">
            <div class="d-md-flex align-items-center justify-content-between mb-5">
                <h1 class="text-2xl font-extrabold text-[#1b1c1c] tracking-tight font-['Plus_Jakarta_Sans']">{{ __('messages.candidate_profile.education') }}</h1>
                <div class="text-end mt-4 mt-md-0">
                    <a class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-[14px] font-bold rounded-xl text-white bg-[#a100ff] hover:bg-[#8e00e2] shadow-[0_4px_12px_rgba(161,0,255,0.2)] transition-all duration-300 font-['Plus_Jakarta_Sans'] cursor-pointer addEducationModal" data-bs-toggle="modal"
                        data-bs-target="#addEducationModal">{{ __('messages.candidate_profile.add_education') }}
                    </a>
                </div>
            </div>
            
            <div class="pt-0 py-4 text-gray-700">
                <div class="row">
                    <div class="candidate-education-container w-full grid grid-cols-1 gap-6">
                        <div class="col-12 {{ $data['candidateEducations']->count() ? 'd-none' : '' }}"
                            id="notfoundEducation">
                            <div class="bg-[#faf7ff] border border-[#e1b6ff] rounded-[16px] p-8 text-center">
                                <h5 class="text-[#807287] font-medium font-['Plus_Jakarta_Sans']">
                                    {{ __('messages.candidate.education_not_found') }}
                                </h5>
                            </div>
                        </div>
                        @php
                            /** @var \App\Models\CandidateEducation $candidateEducation */
                        @endphp
                        @foreach ($data['candidateEducations'] as $candidateEducation)
                            <div class="col-12 candidate-education bg-white border border-[#ede8f5] rounded-[16px] shadow-[0_2px_8px_rgba(0,0,0,0.04)] p-6 transition-all duration-300 hover:shadow-[0_8px_24px_rgba(161,0,255,0.08)] hover:border-[#e1b6ff] relative group"
                                data-education-id="{{ $loop->index }}" data-id="{{ $candidateEducation->id }}">
                                <article class="article article-style-b w-full">
                                    <div class="article-details">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div class="article-title">
                                                <h4 class="text-[18px] font-bold text-[#1b1c1c] font-['Plus_Jakarta_Sans'] mb-1 education-degree-level">
                                                    {{ $candidateEducation->degreeLevel->name }}</h4>
                                                <h6 class="text-[15px] font-semibold text-[#a100ff] font-['Plus_Jakarta_Sans']">{{ $candidateEducation->degree_title }}</h6>
                                            </div>
                                            <div class="article-cta candidate-education-edit-delete flex gap-2">
                                                <a href="javascript:void(0)"
                                                    class="w-8 h-8 rounded-lg bg-[#faf7ff] text-[#a100ff] border border-[#ede8f5] hover:bg-[#a100ff] hover:text-white flex items-center justify-center transition-all duration-200 edit-candidate-education"
                                                    title="{{ __('messages.common.edit') }}" data-bs-toggle="tooltip"
                                                    data-id="{{ $candidateEducation->id }}"><span class="material-symbols-outlined text-[18px]">edit</span></a>
                                                <a href="javascript:void(0)"
                                                    class="delete-education w-8 h-8 rounded-lg bg-red-50 text-red-500 border border-red-100 hover:bg-red-500 hover:text-white flex items-center justify-center transition-all duration-200"
                                                    title="{{ __('messages.common.delete') }}" data-bs-toggle="tooltip"
                                                    data-id="{{ $candidateEducation->id }}"><span class="material-symbols-outlined text-[18px]">delete</span></a>
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-wrap items-center gap-3 text-[14px] text-[#807287] font-medium mb-3">
                                            <div class="flex items-center gap-1.5 bg-gray-50 px-3 py-1 rounded-full">
                                                <span class="material-symbols-outlined text-[16px]">calendar_month</span>
                                                <span>{{ $candidateEducation->year }}</span>
                                            </div>
                                            <div class="flex items-center gap-1.5 bg-gray-50 px-3 py-1 rounded-full">
                                                <span class="material-symbols-outlined text-[16px]">public</span>
                                                <span>{{ $candidateEducation->country }}</span>
                                            </div>
                                        </div>
                                        
                                        <p class="text-[14px] text-[#4e4256] leading-relaxed mb-0">{{ $candidateEducation->institute }}</p>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

    {{--                                @if($candidateExperience->currently_working)--}}
    {{--                                    <span class="text-muted">{{ __('messages.candidate_profile.present') }}</span>--}}
    {{--                                @else--}}
    {{--                                    <span class="text-muted"> {{\Carbon\Carbon::parse($candidateExperience->end_date)->format('jS M, Y')}} </span>--}}
    {{--                                @endif--}}
    {{--                                <span> | {{ $candidateExperience->country }}</span>--}}
    {{--                                @if(!empty($candidateExperience->description))--}}
    {{--                                    <p class="mb-0 pb-md-0 pb-4">{{ Str::limit($candidateExperience->description,225,'...') }}</p>--}}
    {{--                                @endif--}}

    {{--                                <div class="article-cta candidate-experience-edit-delete">--}}
    {{--                                    <a href="javascript:void(0)" class="btn btn-warning action-btn edit-experience" title="Edit"--}}
    {{--                                       data-id="{{ $candidateExperience->id }}"><i class="fa fa-edit p-1"></i></a>--}}
    {{--                                    <a href="javascript:void(0)" class="btn btn-danger action-btn delete-experience" title="Delete"--}}
    {{--                                       data-id="{{ $candidateExperience->id }}"><i class="fa fa-trash p-1"></i></a>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </article>--}}
    {{--                    </div>--}}
    {{--                @endforeach--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    {{--    <br>--}}
    {{--    <section class="section">--}}
    {{--        <div class="section-header candidate-experience-header">--}}
    {{--            <h1>{{ __('messages.candidate_profile.education') }}</h1>--}}
    {{--            <div class="section-header-breadcrumb justify-content-end">--}}
    {{--                <a--}}
    {{--                   class="btn btn-primary form-btn addEducationModal" data-bs-toggle="modal"--}}
    {{--                   data-bs-target="#addEducationModal">{{ __('messages.candidate_profile.add_education') }}--}}
    {{--                    <i class="fas fa-plus"></i></a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="section-body">--}}
    {{--            <div class="row candidate-education-container">--}}
    {{--                <div class="col-12 {{ ($data['candidateEducations']->count()) ? 'd-none' : '' }}" id="notfoundEducation">--}}
    {{--                    <h4 class="product-item pb-5 d-flex justify-content-center">--}}
    {{--                        {{ __('messages.candidate.education_not_found') }}--}}
    {{--                    </h4>--}}
    {{--                </div>--}}
    {{--                @php--}}
    {{--                    /** @var \App\Models\CandidateEducation $candidateEducation */--}}
    {{--                @endphp--}}
    {{--                @foreach($data['candidateEducations'] as $candidateEducation)--}}
    {{--                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-education"--}}
    {{--                         data-education-id="{{ $loop->index }}" data-id="{{ $candidateEducation->id }}">--}}
    {{--                        <article class="article article-style-b">--}}
    {{--                            <div class="article-details">--}}
    {{--                                <div class="article-title">--}}
    {{--                                    <h4 class="text-primary education-degree-level">{{ $candidateEducation->degreeLevel->name }}</h4>--}}
    {{--                                    <h6 class="text-muted">{{ $candidateEducation->degree_title }}</h6>--}}
    {{--                                </div>--}}
    {{--                                <span class="text-muted">{{ $candidateEducation->year }} | {{ $candidateEducation->country }}</span>--}}
    {{--                                <p class="mb-0 pb-md-0 pb-4">{{ $candidateEducation->institute }}</p>--}}
    {{--                                <div class="article-cta candidate-education-edit-delete">--}}
    {{--                                    <a href="javascript:void(0)" class="btn btn-warning action-btn edit-education" title="Edit"--}}
    {{--                                       data-id="{{ $candidateEducation->id }}"><i class="fa fa-edit p-1"></i></a>--}}
    {{--                                    <a href="javascript:void(0)" class="btn btn-danger action-btn delete-education" title="Delete"--}}
    {{--                                       data-id="{{ $candidateEducation->id }}"><i class="fa fa-trash p-1"></i></a>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </article>--}}
    {{--                    </div>--}}
    {{--                @endforeach--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    @include('candidate.profile.modals.add_experience_modal')
    @include('candidate.profile.modals.add_education_modal')
    @include('candidate.profile.modals.edit_experience_modal')
    @include('candidate.profile.modals.edit_education_modal')
    @include('candidate.profile.templates.templates')
    {{ Form::hidden('indexCareerInfoData', true, ['id' => 'indexCareerInfoData']) }}
@endsection
@push('scripts')
    <script>
        {{-- let addExperienceUrl = "{{ route('candidate.create-experience') }}"; --}}
        {{-- let experienceUrl = "{{ url('candidate/candidate-experience') }}/"; --}}
        {{-- let addEducationUrl = "{{ route('candidate.create-education') }}"; --}}
        {{-- let candidateUrl = "{{ url('candidate') }}/"; --}}
        {{-- let educationUrl = "{{ url('candidate/candidate-education') }}/"; --}}
        {{-- let present = "{{ __('messages.candidate_profile.present') }}"; --}}
        // let isEdit = false;
    </script>
    {{--    <script src="{{ asset('assets/js/moment.min.js') }}"></script> --}}
    {{--    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script> --}}
    {{--    <script src="{{mix('assets/js/candidate-profile/candidate_career_informations.js')}}"></script> --}}
@endpush
