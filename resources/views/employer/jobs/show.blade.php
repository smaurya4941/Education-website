@extends('employer.layouts.app')
@section('title')
    {{ __('messages.job.job_details') }}
@endsection
@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-[32px] font-extrabold text-[#1b1c1c] tracking-tight font-['Plus_Jakarta_Sans'] leading-tight">{{ __('messages.job.job_details') }}</h1>
            <p class="text-[15px] text-[#807287] mt-1.5 font-['Plus_Jakarta_Sans']">Review the detailed information for this job posting.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('job.edit',$job->id) }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-[15px] font-bold rounded-xl text-white bg-[#a100ff] hover:bg-[#8e00e2] shadow-[0_4px_12px_rgba(161,0,255,0.2)] transition-all duration-300 font-['Plus_Jakarta_Sans']">
                {{ __('messages.common.edit') }}
            </a>
            <a href="{{ route('job.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-[#d1c1d8] text-[15px] font-bold rounded-xl text-[#4e4256] bg-white hover:border-[#a100ff] hover:text-[#a100ff] shadow-[0_2px_8px_rgba(0,0,0,0.04)] transition-all duration-300 font-['Plus_Jakarta_Sans']">
                {{ __('messages.common.back') }}
            </a>
        </div>
    </div>
    
    <div class="bg-white border border-[#ede8f5] rounded-[24px] shadow-[0_4px_20px_rgba(161,0,255,0.06)] p-6 lg:p-8 mb-8">
        @include('employer.jobs.show_fields')
    </div>
@endsection
