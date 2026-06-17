@extends('candidate.layouts.app')
@section('title')
    {{ __('messages.job.job_alert') }}
@endsection
@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-[32px] font-extrabold text-[#1b1c1c] tracking-tight font-['Plus_Jakarta_Sans'] leading-tight">{{ __('messages.job.job_alert') }}</h1>
            <p class="text-[15px] text-[#807287] mt-1.5 font-['Plus_Jakarta_Sans']">Configure alerts to receive notifications for suitable jobs.</p>
        </div>
    </div>

    @include('flash::message')
    @include('layouts.errors')

    <div class="bg-white border border-[#ede8f5] rounded-[24px] shadow-[0_4px_20px_rgba(161,0,255,0.06)] p-6 lg:p-8 mb-8">
        {{ Form::open(['route' => 'candidate.job.alert.update']) }}
        
        <div class="mb-6 flex items-center justify-start gap-3">
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="job_alert" value="1" class="sr-only peer" {{ ($candidate->job_alert) ? 'checked' : '' }}>
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#a100ff]"></div>
            </label>
            <span class="text-[15px] font-medium text-[#4e4256]">{{ __('messages.candidate.job_alert_message') }}</span>
        </div>
        
        <div class="border-t border-[#ede8f5] pt-6 mb-6 {{ checkLanguageSession() == 'ar' ? 'mr-4' : 'ml-4' }}">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($jobTypes as $jobType)
                    <div class="flex items-center justify-start gap-3">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="job_types[]" value="{{ $jobType->id }}" class="sr-only peer" {{ in_array($jobType->id,$jobAlerts) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#a100ff]"></div>
                        </label>
                        <span class="text-[15px] text-[#4e4256]">{{ htmlspecialchars_decode($jobType->name) }}</span>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="border-t border-[#ede8f5] pt-6 flex justify-end">
            {{ Form::submit(__('messages.common.save'), ['class' => 'inline-flex items-center justify-center px-6 py-3 border border-transparent text-[15px] font-bold rounded-xl text-white bg-[#a100ff] hover:bg-[#8e00e2] shadow-[0_4px_12px_rgba(161,0,255,0.2)] transition-all duration-300 font-[\'Plus_Jakarta_Sans\'] cursor-pointer',]) }}
        </div>
        {{ Form::close() }}
    </div>
@endsection
