@extends('candidate.layouts.app')
@section('title')
    {{ __('messages.applied_job.applied_jobs') }}
@endsection
@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-[32px] font-extrabold text-[#1b1c1c] tracking-tight font-['Plus_Jakarta_Sans'] leading-tight">{{ __('messages.applied_job.applied_jobs') }}</h1>
            <p class="text-[15px] text-[#807287] mt-1.5 font-['Plus_Jakarta_Sans']">Manage and track the jobs you have applied for.</p>
        </div>
    </div>
    <div class="bg-white border border-[#ede8f5] rounded-[24px] shadow-[0_4px_20px_rgba(161,0,255,0.06)] p-6 lg:p-8 mb-8">
        @include('flash::message')
        <livewire:applied-jobs/>
    </div>
    @include('candidate.applied_job.show_applied_jobs_modal')
    @include('candidate.applied_job.templates.templates')
    @include('candidate.applied_job.schedule_slot_book')
@endsection
