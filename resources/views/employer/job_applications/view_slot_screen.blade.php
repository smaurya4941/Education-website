@extends('employer.layouts.app')
@section('title')
    {{ __('messages.job_stage.slots') }}
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css') }}">
@endpush
@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-[32px] font-extrabold text-[#1b1c1c] tracking-tight font-['Plus_Jakarta_Sans'] leading-tight">{{ __('messages.job_stage.slots') }}</h1>
        </div>
        <div>
            <a href="{{ url('employer/jobs/'.request()->route('jobId').'/applications') }}" class="inline-flex items-center justify-center px-6 py-3 border border-[#d1c1d8] text-[15px] font-bold rounded-xl text-[#4e4256] bg-white hover:border-[#a100ff] hover:text-[#a100ff] shadow-[0_2px_8px_rgba(0,0,0,0.04)] transition-all duration-300 font-['Plus_Jakarta_Sans']">
                {{ __('messages.common.back') }}
            </a>
        </div>
    </div>
    @include('flash::message')
        <div class="d-flex flex-column">
            @include('layouts.errors')
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        @php
                            $stageId = null;
                        @endphp
                        @if(isset($lastStage) && $jobStage->isNotEmpty())
                            @php
                                $stageId = $lastStage->stage_id;
                            @endphp
                            <div class="w-25">
                                {{ Form::select('stage_id', $jobStage, $lastStage->stage_id, ['id' => 'stages', 'class' => 'form-select status-filter w-100']) }}
                            </div>
                        @endif
                        @if($isSelectedRejectedSlot > 0 || $isStageMatch)
                            <div class="d-flex align-items-center me-4 me-md-5 form-btn schedule-interview">
                                <a href="javascript:void(0)"
                                   class="btn btn-primary addJobStageModal ms-2">
                                    {{ __('messages.common.add') }}
                                </a>
                            </div>
                        @endif
                    </div>
                    <hr>
                    @livewire('view-slot-screen',['applicationId'=>$applicationId, 'stageId'=>$stageId])
                </div>
            </div>
            @include('employer.job_applications.schedule_interview_modal')
{{--            @include('employer.job_applications.templates.templates')--}}
            @include('employer.job_applications.add_batch_slot_modal')
            @include('employer.job_applications.edit_batch_slot_modal')
        </div>
        {{Form::hidden('indexEmployerJobSlot',true,['id'=>'indexEmployerJobSlot'])}}
@endsection
@push('scripts')
    <script>
        var interviewSlotStoreUrl = "{{ route('interview.slot.store', ['jobId' => request()->route('jobId')]) }}";
        var batchSlotStoreUrl = "{{ route('batch.slot.store', ['jobId' => request()->route('jobId')]) }}";
        var uniqueId = 1;
        var JobApplicationId = "{{ request()->route('jobApplicationId') }}";
        var getScheduleHistory = "{{ route('get.schedule.history', ['jobId' => request()->route('jobId')]) }}";
        var cancelSlotUrl = "{{ route('cancel.selected.slot', ['jobId' => request()->route('jobId')]) }}";
        var jobApplicationUrl = "{{url('employer/jobs/'.request()->route('jobId').'/applications')}}";
    </script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    {{--    <script src="{{ asset('assets/js/job_applications/job_slots.js') }}"></script>--}}
@endpush

