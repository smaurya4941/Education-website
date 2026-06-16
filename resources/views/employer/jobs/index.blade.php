@extends('employer.layouts.app')
@section('title')
    {{ __('messages.jobs') }}
@endsection
@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-[32px] font-extrabold text-[#1b1c1c] tracking-tight font-['Plus_Jakarta_Sans'] leading-tight">{{ __('messages.jobs') }}</h1>
            <p class="text-[15px] text-[#807287] mt-1.5 font-['Plus_Jakarta_Sans']">Manage your job postings, edit details, and track their performance.</p>
        </div>
        <div>
            <a href="{{ route('job.create') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-[15px] font-bold rounded-xl text-white bg-[#a100ff] hover:bg-[#8e00e2] shadow-[0_4px_12px_rgba(161,0,255,0.2)] transition-all duration-300 font-['Plus_Jakarta_Sans']">
                {{ __('messages.job.new_job') }}
            </a>
        </div>
    </div>
    
    <div class="bg-white border border-[#ede8f5] rounded-[24px] shadow-[0_4px_20px_rgba(161,0,255,0.06)] p-6 lg:p-8 mb-8">
        @include('flash::message')
        <livewire:employer-job-table lazy/>
    </div>

    {{Form::hidden('indexEmployeeJobsData',true,['id'=>'indexEmployeeJobsData'])}}
    {{Form::hidden('statusArray',json_encode($statusArray),['id'=>'employerJobStatusArray'])}}
    @include('employer.jobs.reason_show_model')
@endsection
