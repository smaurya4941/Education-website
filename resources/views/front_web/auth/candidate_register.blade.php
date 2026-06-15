@extends('front_web.layouts.app')
@section('title')
    {{ __('web.register') }}
@endsection
@section('page_css')
<style>
    .bw-auth-container { font-family: 'Plus Jakarta Sans', sans-serif; background: #f9f9f9; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 15px; }
    .bw-auth-card { background: #ffffff; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.05); padding: 40px; width: 100%; max-width: 600px; }
    .bw-auth-title { font-size: 28px; font-weight: 800; color: #1b1c1c; margin-bottom: 8px; text-align: center; }
    .bw-auth-subtitle { font-size: 14px; color: #6c6a77; text-align: center; margin-bottom: 32px; }
    .bw-auth-tabs { display: flex; gap: 10px; margin-bottom: 32px; background: #f5f3f3; padding: 6px; border-radius: 8px; }
    .bw-auth-tab { flex: 1; text-align: center; padding: 10px; border-radius: 6px; font-size: 14px; font-weight: 600; color: #4e4256; text-decoration: none; transition: all 0.2s; }
    .bw-auth-tab.active { background: #ffffff; color: #a100ff; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
    .bw-auth-tab:hover:not(.active) { color: #1b1c1c; }
    .bw-input-group { margin-bottom: 20px; }
    .bw-label { display: block; font-size: 13px; font-weight: 600; color: #1b1c1c; margin-bottom: 8px; }
    .bw-input { width: 100%; padding: 14px 20px; border-radius: 8px; border: 1px solid #e4e2e2; background: #ffffff; font-size: 14px; color: #1b1c1c; outline: none; transition: border-color 0.2s; }
    .bw-input:focus { border-color: #a100ff; }
    .bw-btn { width: 100%; padding: 14px; border-radius: 8px; background: #a100ff; color: #ffffff; font-size: 15px; font-weight: 600; border: none; cursor: pointer; transition: background 0.2s; text-align: center; display: block; text-decoration: none; }
    .bw-btn:hover { background: #8b00db; color: #ffffff; }
    .bw-checkbox-label { font-size: 14px; color: #4e4256; margin-left: 8px; cursor: pointer; line-height: 1.5; }
    .bw-social-btn { display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #e4e2e2; background: #ffffff; color: #4e4256; font-size: 14px; font-weight: 600; text-decoration: none; margin-bottom: 12px; transition: background 0.2s; }
    .bw-social-btn:hover { background: #f5f3f3; }
    .bw-forgot-link { font-size: 14px; font-weight: 600; color: #a100ff; text-decoration: none; }
    .bw-forgot-link:hover { text-decoration: underline; }
</style>
@endsection
@section('content')
<div class="bw-auth-container">
    <div class="bw-auth-card">
        <h1 class="bw-auth-title">{{ __('web.register') }}</h1>
        <p class="bw-auth-subtitle">Create an account to get started.</p>

        @include('flash::message')

        <div class="bw-auth-tabs">
            <a href="{{ route('candidate.register') }}" class="bw-auth-tab active">{{ __('web.register_menu.candidate') }}</a>
            <a href="{{ route('employer.register') }}" class="bw-auth-tab">{{ __('web.register_menu.employer') }}</a>
        </div>

        <form method="POST" id="addCandidateNewForm">
            @csrf
            <div id="candidateValidationErrBox">
                @include('layouts.errors')
            </div>
            <input type="hidden" name="type" value="1" />
            
            <div class="row">
                <div class="col-md-6">
                    <div class="bw-input-group">
                        <label for="candidateFirstName" class="bw-label">{{ __('web.common.first_name') }} <span class="text-danger">*</span></label>
                        <input type="text" class="bw-input" name="first_name" id="candidateFirstName" placeholder="{{ __('web.register_menu.enter_first_name') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bw-input-group">
                        <label for="candidateLastName" class="bw-label">{{ __('web.common.last_name') }} <span class="text-danger">*</span></label>
                        <input type="text" class="bw-input" name="last_name" id="candidateLastName" placeholder="{{ __('web.register_menu.enter_last_name') }}" required>
                    </div>
                </div>
            </div>

            <div class="bw-input-group">
                <label for="candidateEmail" class="bw-label">{{ __('web.common.email') }} <span class="text-danger">*</span></label>
                <input type="email" class="bw-input" name="email" id="candidateEmail" placeholder="{{ __('web.register_menu.enter_email_address') }}" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="bw-input-group" style="position: relative;">
                        <label for="candidatePassword" class="bw-label">{{ __('web.common.password') }} <span class="text-danger">*</span></label>
                        <input type="password" class="bw-input" name="password" id="candidatePassword" placeholder="{{ __('web.register_menu.enter_password') }}" required onkeypress="return avoidSpace(event)">
                        <span class="position-absolute d-flex align-items-center top-50 translate-middle-y {{ getFrontSelectLanguage() == 'ar' ? 'start-0 ms-3' : 'end-0 me-3' }} input-icon input-password-hide cursor-pointer text-gray-600 change-type change-type-register" style="margin-top: 14px;">
                            <i class="fas fa-eye-slash"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bw-input-group" style="position: relative;">
                        <label for="candidateConfirmPassword" class="bw-label">{{ __('web.common.confirm_password') }} <span class="text-danger">*</span></label>
                        <input type="password" class="bw-input" name="password_confirmation" id="candidateConfirmPassword" placeholder="{{ __('web.register_menu.confirm_password') }}" required onkeypress="return avoidSpace(event)">
                        <span class="position-absolute d-flex align-items-center top-50 translate-middle-y {{ getFrontSelectLanguage() == 'ar' ? 'start-0 ms-3' : 'end-0 me-3' }} input-icon input-password-hide cursor-pointer text-gray-600 change-type change-type-register" style="margin-top: 14px;">
                            <i class="fas fa-eye-slash"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="d-flex align-items-start">
                    <input type="checkbox" name="privacyPolicy" id="remember" style="accent-color: #a100ff; margin-top: 4px;">
                    <label class="bw-checkbox-label" for="remember">
                        @lang('messages.by_signing_up_you_agree_to_our')
                        <a href="{{ route('terms.conditions.list') }}" target="_blank" class="bw-forgot-link">{{ __('messages.setting.terms_conditions') }}</a>
                        &
                        <a href="{{ route('privacy.policy.list') }}" target="_blank" class="bw-forgot-link">{{ __('messages.setting.privacy_policy') }}</a>.
                    </label>
                </div>
            </div>

            @if ($isGoogleReCaptchaEnabled)
                <div class="mb-4 d-flex justify-content-center">
                    <div class="g-recaptcha" id="gRecaptchaContainerCompanyRegistration" data-sitekey="{{ config('app.google_recaptcha_site_key') }}"></div>
                    <div id="g-recaptcha-error"></div>
                </div>
            @endif

            <button type="submit" class="bw-btn mb-4" id="btnCandidateSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> {{ __('messages.common.process') }}">
                {{ __('web.register_menu.create_account') }}
            </button>
            
            <div class="text-center mb-4" style="font-size: 14px; color: #6c6a77;">
                {{ __('Already have an account') }} 
                <a href="{{ route('front.candidate.login') }}" class="bw-forgot-link" style="font-weight: 700;">{{ __('web.login') }}</a>
            </div>

            @php $envSetting = getEnvSetting(); @endphp
            @if( (!empty($envSetting['facebook_app_id'] || config('services.facebook.client_id')) && !empty($envSetting['facebook_app_secret'] || config('services.facebook.client_secret')) && !empty($envSetting['facebook_redirect'] || config('services.facebook.redirect'))) || (!empty($envSetting['google_client_id'] || config('services.google.client_id')) && !empty($envSetting['google_client_secret'] || config('services.google.client_secret')) && !empty($envSetting['google_redirect'] || config('services.google.redirect'))) || (!empty($envSetting['linkedin_client_id'] || config('services.linkedin-openid.client_id')) && !empty($envSetting['linkedin_client_secret'] || config('services.linkedin-openid.client_secret')) && !empty(config('services.linkedin-openid.redirect'))) )
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                    <div style="flex: 1; height: 1px; background: #e4e2e2;"></div>
                    <span style="font-size: 12px; color: #807287; text-transform: uppercase; font-weight: 600;">Or register with</span>
                    <div style="flex: 1; height: 1px; background: #e4e2e2;"></div>
                </div>

                @if (!empty($envSetting['google_client_id'] || config('services.google.client_id')) && !empty($envSetting['google_client_secret'] || config('services.google.client_secret')) && !empty($envSetting['google_redirect'] || config('services.google.redirect')))
                    <a href="{{ url('/login/google?type=1') }}" class="bw-social-btn">
                        <i class="fa-brands fa-google text-danger fs-5"></i> {{ __('web.login_menu.login_via_google') }}
                    </a>
                @endif
                @if (!empty($envSetting['facebook_app_id'] || config('services.facebook.client_id')) && !empty($envSetting['facebook_app_secret'] || config('services.facebook.client_secret')) && !empty($envSetting['facebook_redirect'] || config('services.facebook.redirect')))
                    <a href="{{ url('/login/facebook?type=1') }}" class="bw-social-btn">
                        <i class="fa-brands fa-facebook-f text-primary fs-5"></i> {{ __('web.login_menu.login_via_facebook') }}
                    </a>
                @endif
                @if (!empty($envSetting['linkedin_client_id'] || config('services.linkedin-openid.client_id')) && !empty($envSetting['linkedin_client_secret'] || config('services.linkedin-openid.client_secret')) && !empty(config('services.linkedin-openid.redirect')))
                    <a href="{{ url('/login/linkedin-openid?type=1') }}" class="bw-social-btn">
                        <i class="fa-brands fa-linkedin-in text-info fs-5"></i> {{ __('web.login_menu.login_via_linkedin') }}
                    </a>
                @endif
            @endif
        </form>
    </div>
</div>
{{ Form::hidden('isGoogleReCaptchaEnabled', (bool) $isGoogleReCaptchaEnabled, ['id' => 'isGoogleReCaptchaEnabled']) }}
@endsection

{{-- @section('page_scripts') --}}
{{--    <script> --}}
{{--        let registerSaveUrl = "{{ route('front.save.register') }}"; --}}
{{--        let candidateLogInUrl = "{{ route('front.candidate.login') }}"; --}}
{{--        let isGoogleReCaptchaEnabled = "{{ (boolean)$isGoogleReCaptchaEnabled }}"; --}}

{{--    </script> --}}
{{--    @if ($isGoogleReCaptchaEnabled) --}}
{{--        <script src='https://www.google.com/recaptcha/api.js'></script> --}}
{{--        <script src="{{asset('assets/js/front_register/google-recaptcha.js')}}"></script> --}}
{{--    @endif --}}
{{-- @endsection --}}
