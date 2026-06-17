@extends('employer.layouts.app')
@section('title')
    {{ __('messages.company.followers') }}
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('css/header-padding.css') }}">
@endpush
@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-[32px] font-extrabold text-[#1b1c1c] tracking-tight font-['Plus_Jakarta_Sans'] leading-tight">{{ __('messages.company.followers') }}</h1>
            <p class="text-[15px] text-[#807287] mt-1.5 font-['Plus_Jakarta_Sans']">Manage candidates who are following your company.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('employer.dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 border border-[#d1c1d8] text-[15px] font-bold rounded-xl text-[#4e4256] bg-white hover:border-[#a100ff] hover:text-[#a100ff] shadow-[0_2px_8px_rgba(0,0,0,0.04)] transition-all duration-300 font-['Plus_Jakarta_Sans']">
                {{ __('messages.common.back') }}
            </a>
        </div>
    </div>
    
    <div class="bg-white border border-[#ede8f5] rounded-[24px] shadow-[0_4px_20px_rgba(161,0,255,0.06)] p-6 lg:p-8 mb-8">
        @include('flash::message')
        <livewire:employer-follower-table lazy/>
    </div>
@endsection
