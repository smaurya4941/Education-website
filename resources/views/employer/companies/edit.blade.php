@extends('employer.layouts.app')
@section('title')
    {{ __('messages.company.edit_employer') }}
@endsection
@push('css')
    {{--    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/inttel/css/intlTelInput.css') }}">
@endpush
@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-[32px] font-extrabold text-[#1b1c1c] tracking-tight font-['Plus_Jakarta_Sans'] leading-tight">{{ __('messages.company.edit_employer') }}</h1>
            <p class="text-[15px] text-[#807287] mt-1.5 font-['Plus_Jakarta_Sans']">Update your company profile information.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @include('layouts.errors')
            @include('flash::message')
            <div class="alert alert-danger  hide d-none" id="editValidationErrorsBox">
                <i class="fa-solid fa-face-frown me-5"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white border border-[#ede8f5] rounded-[24px] shadow-[0_4px_20px_rgba(161,0,255,0.06)] p-6 lg:p-8 mb-8">
        {{ Form::model($user, ['route' => ['company.update.form', $company->id], 'method' => 'put', 'id' => 'editCompanyForm']) }}
        @if ($isFeaturedEnable)
            <div class="d-flex justify-content-end mb-4">
                @if ($company->activeFeatured)
                    <div class="badge badge-info text-gray-900 d-inline-block rounded">
                        {{ __('messages.front_settings.featured') }}
                        {{ __('messages.front_settings.exipre_on') }}
                        {{ (new Carbon\Carbon($company->activeFeatured->end_time))->format('d/m/y') }}</div>
                @else
                    @if ($isFeaturedAvilabal)
                        <a class="btn btn-info btn-sm"
                            id="makeFeatured">{{ __('messages.front_settings.make_featured') }}</a>
                    @endif
                @endif
            </div>
        @endif
        @include('employer.companies.edit_fields')
        {{ Form::close() }}
        {{ Form::hidden('countryId', $company->user->country_id, ['id' => 'countryId']) }}
        {{ Form::hidden('stateId', $company->user->state_id, ['id' => 'stateId']) }}
        {{ Form::hidden('cityId', $company->user->city_id, ['id' => 'cityId']) }}
        {{ Form::hidden('companyId', $company->id, ['id' => 'employerCompanyId']) }}
        {{ Form::hidden('employerPanel', true, ['class' => 'employerPanel']) }}
        {{ Form::hidden('isEdit', true, ['class' => 'isEdit']) }}
    </div>
@endsection

@push('scripts')
    {{--    <script src="https://js.stripe.com/v3/"></script> --}}
    <script>
        var phoneNo = "{{ old('region_code') . old('phone') }}";
    </script>
    {{--    <script src="{{mix('assets/js/companies/create-edit.js')}}"></script> --}}
    {{--    <script src="{{ asset('assets/js/companies/companies_stripe_payment.js') }}"></script> --}}
    {{--    <script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script> --}}
@endpush
