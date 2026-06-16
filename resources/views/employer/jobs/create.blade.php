@extends('employer.layouts.app')
@section('title')
    {{ __('messages.job.new_job') }}
@endsection
@push('css')
    {{--    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>--}}
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-[32px] font-extrabold text-[#1b1c1c] tracking-tight font-['Plus_Jakarta_Sans'] leading-tight">{{ __('messages.job.new_job') }}</h1>
            <p class="text-[15px] text-[#807287] mt-1.5 font-['Plus_Jakarta_Sans']">Create a new job posting to attract the best talent.</p>
        </div>
        <div>
            <a href="{{ route('job.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-[#d1c1d8] text-[15px] font-bold rounded-xl text-[#4e4256] bg-white hover:border-[#a100ff] hover:text-[#a100ff] shadow-[0_2px_8px_rgba(0,0,0,0.04)] transition-all duration-300 font-['Plus_Jakarta_Sans']">
                {{ __('messages.common.back') }}
            </a>
        </div>
    </div>
    
    <div class="bg-white border border-[#ede8f5] rounded-[24px] shadow-[0_4px_20px_rgba(161,0,255,0.06)] p-6 lg:p-8 mb-8">
        @include('layouts.errors')
        {{ Form::open(['route' => 'job.store','id' => 'createJobForm']) }}
        @include('employer.jobs.fields')
        {{ Form::close() }}
    </div>
    
    {{Form::hidden('employeeJobForm',true,['id'=>'employeeJobForm'])}}
    {{Form::hidden('employerPanel',true,['class'=>'jobEmployeePanel'])}}
    {{Form::hidden('isEdit',true,['class'=>'isEdit'])}}
@endsection
