@extends('candidate.profile.index')
@section('section')
<div class="bg-white border border-[#ede8f5] rounded-[24px] shadow-[0_4px_20px_rgba(161,0,255,0.06)] p-6 lg:p-8 mb-8">
    <livewire:resume-table lazy/>
</div>
@include('candidate.profile.modals.upload_resume_modal')
@endsection
