@extends('employer.layouts.app')
@section('title')
    {{ __('messages.employer_dashboard.dashboard') }}
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
@endpush
@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-[32px] font-extrabold text-[#1b1c1c] tracking-tight font-['Plus_Jakarta_Sans'] leading-tight">{{ __('messages.employer_dashboard.dashboard') }}</h1>
            <p class="text-[15px] text-[#807287] mt-1.5 font-['Plus_Jakarta_Sans']">Welcome back! Manage your jobs, track applications, and hire top talent.</p>
        </div>
        <div>
            @if(isset($isJobLimitExceeded) && $isJobLimitExceeded)
                <button disabled class="inline-flex items-center gap-2 px-6 py-3 bg-gray-400 text-white rounded-xl font-bold cursor-not-allowed shadow-none">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    {{ __('messages.job.new_job') }}
                </button>
            @else
                <a href="{{ route('job.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#a100ff] text-white rounded-xl font-bold hover:bg-[#8600d4] transition-all shadow-[0_4px_12px_rgba(161,0,255,0.24)]">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    {{ __('messages.job.new_job') }}
                </a>
            @endif
        </div>
    </div>

    @if(isset($isJobLimitExceeded) && $isJobLimitExceeded)
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8 rounded-r-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)]">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="material-symbols-outlined text-red-500 text-2xl">error</span>
                </div>
                <div class="ml-3">
                    <p class="text-[15px] text-red-700 font-medium font-['Plus_Jakarta_Sans'] m-0">
                        {!! __('messages.flash.job_create_limit') !!}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <livewire:employer-dashboard lazy/>

    <div class="bg-white border border-[#ede8f5] rounded-[24px] shadow-[0_4px_20px_rgba(161,0,255,0.06)] mb-8 overflow-hidden">
        <!--begin::Header-->
        <div class="p-6 lg:p-8 border-b border-[#ede8f5] flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <h3 class="text-xl font-extrabold text-[#1b1c1c] flex items-center gap-3 font-['Plus_Jakarta_Sans']">
                <span class="material-symbols-outlined text-[#a100ff] bg-[#faf7ff] p-2 rounded-xl">bar_chart</span>
                {{ __('messages.job_applications') }}
            </h3>
            <div class="w-full lg:w-auto">
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3">
                    <div class="w-full sm:w-48">
                        <div class="card-header-action w-100">
                            {{  Form::select('jobs', $jobStatus, null, ['id' => 'jobStatus', 'class' => 'form-control status-filter', 'placeholder' => __('messages.flash.select_job')]) }}
                        </div>
                    </div>
                    <div class="w-full sm:w-48">
                        <div class="card-header-action w-100">
                            {{  Form::select('gender', getTranslatedData($gender), null, ['id' => 'gender', 'class' => 'form-control status-filter', 'placeholder' => __('messages.company.select_gender')]) }}
                        </div>
                    </div>
                    <div class="w-full sm:w-auto">
                        <div id="timeRange" class="time_range border border-[#d1c1d8] rounded-[14px] py-2.5 px-4 flex items-center justify-between bg-white text-[#4e4256] hover:border-[#a100ff] transition-all cursor-pointer text-[14px] font-medium gap-3 font-['Plus_Jakarta_Sans'] shadow-[0_2px_8px_rgba(0,0,0,0.04)]">
                            <span class="material-symbols-outlined text-[#807287] text-[20px]">calendar_today</span>
                            <span class="font-semibold text-[#1b1c1c]"></span>
                            <b class="caret text-[#807287]"></b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="jobContainer" class="p-6 lg:p-8">
            <canvas id="employerDashboardChart" class="w-full" style="max-height: 400px;"></canvas>
        </div>
    </div>

    <div class="bg-white border border-[#ede8f5] rounded-[24px] shadow-[0_4px_20px_rgba(161,0,255,0.06)] p-6 lg:p-8 mb-8">
        <livewire:employer-dashboard-table lazy/>
    </div>
@endsection
