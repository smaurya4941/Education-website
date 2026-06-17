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
        <div class="flex items-center gap-3">
            <a href="{{ route('employer.dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 border border-[#d1c1d8] text-[15px] font-bold rounded-xl text-[#4e4256] bg-white hover:border-[#a100ff] hover:text-[#a100ff] shadow-[0_2px_8px_rgba(0,0,0,0.04)] transition-all duration-300 font-['Plus_Jakarta_Sans']">
                {{ __('messages.common.back') }}
            </a>
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

    @if(session('ask_create_new_job'))
        @push('scripts')
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    setTimeout(function() {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    title: "{{ __('messages.job.new_job') }}?",
                                    text: "Do you want to create a new job post?",
                                    icon: 'success',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes',
                                    cancelButtonText: 'No',
                                    customClass: {
                                        confirmButton: 'btn btn-primary mr-3',
                                        cancelButton: 'btn btn-secondary'
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "{{ route('job.create') }}";
                                    }
                                });
                            } else if (typeof swal !== 'undefined') {
                                swal({
                                    title: "{{ __('messages.job.new_job') }}?",
                                    text: "Do you want to create a new job post?",
                                    icon: "success",
                                    buttons: {
                                        cancel: "No",
                                        confirm: "Yes"
                                    },
                                }).then((willCreate) => {
                                    if (willCreate) {
                                        window.location.href = "{{ route('job.create') }}";
                                    }
                                });
                            } else {
                                if (confirm("Do you want to create a new job post?")) {
                                    window.location.href = "{{ route('job.create') }}";
                                }
                            }
                    }, 500);
                });
            </script>
        @endpush
    @endif
@endsection
