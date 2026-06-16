@extends('employer.layouts.app')
@section('title')
    {{ __('messages.job_stage.job_stage') }}
@endsection
@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-[32px] font-extrabold text-[#1b1c1c] tracking-tight font-['Plus_Jakarta_Sans'] leading-tight">{{ __('messages.job_stage.job_stage') }}</h1>
            <p class="text-[15px] text-[#807287] mt-1.5 font-['Plus_Jakarta_Sans']">Manage custom stages for your job hiring process.</p>
        </div>
    </div>
    
    <div class="bg-white border border-[#ede8f5] rounded-[24px] shadow-[0_4px_20px_rgba(161,0,255,0.06)] p-6 lg:p-8 mb-8">
        @include('flash::message')
        <livewire:job-stage-table lazy/>
    </div>

    @include('employer.job_stages.add_modal')
    @include('employer.job_stages.edit_modal')
    @include('employer.job_stages.show_modal')
@endsection
{{--@push('scripts')--}}
{{--    <script src="{{mix('assets/js/job_stages/job_stages.js')}}"></script>--}}
{{--@endpush--}}
