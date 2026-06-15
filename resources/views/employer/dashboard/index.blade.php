@extends('employer.layouts.app')
@section('title')
    {{ __('messages.employer_dashboard.dashboard') }}
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
@endpush
@section('content')
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">{{ __('messages.employer_dashboard.dashboard') }}</h1>
            <p class="text-sm text-gray-500 mt-1">Welcome back! Manage your jobs, track applications, and hire top talent.</p>
        </div>
    </div>

    <livewire:employer-dashboard lazy/>

    <div class="bg-white border border-gray-100 rounded-xl shadow-sm mb-8 overflow-hidden">
        <!--begin::Header-->
        <div class="p-6 border-b border-gray-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <span class="material-symbols-outlined text-[#a100ff]">bar_chart</span>
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
                        <div id="timeRange" class="time_range border border-gray-200 rounded-lg py-2 px-3 flex items-center justify-between bg-white text-gray-700 hover:border-[#a100ff] transition-all cursor-pointer text-sm gap-2">
                            <span class="material-symbols-outlined text-gray-400 text-lg">calendar_today</span>
                            <span class="font-medium text-gray-600"></span>
                            <b class="caret text-gray-400"></b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="jobContainer" class="p-6">
            <canvas id="employerDashboardChart" class="w-full" style="max-height: 400px;"></canvas>
        </div>
    </div>

    <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-6 mb-8">
        <livewire:employer-dashboard-table lazy/>
    </div>
@endsection
