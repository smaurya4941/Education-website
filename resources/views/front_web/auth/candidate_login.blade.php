@extends('front_web.layouts.app')
@section('title')
    {{ __('web.login') }}
@endsection
@section('page_css')
<style>
    .bw-auth-container { font-family: 'Plus Jakarta Sans', sans-serif; background: #f9f9f9; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 15px; }
    .bw-auth-card { background: #ffffff; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.05); padding: 40px; width: 100%; max-width: 500px; }
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
    .bw-forgot-link { font-size: 13px; font-weight: 600; color: #a100ff; text-decoration: none; }
    .bw-forgot-link:hover { text-decoration: underline; }
    .bw-checkbox-label { font-size: 14px; color: #4e4256; margin-left: 8px; cursor: pointer; }
    .bw-social-btn { display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #e4e2e2; background: #ffffff; color: #4e4256; font-size: 14px; font-weight: 600; text-decoration: none; margin-bottom: 12px; transition: background 0.2s; }
    .bw-social-btn:hover { background: #f5f3f3; }
</style>
@endsection
@section('content')
<div class="bw-auth-container">
    <div class="bw-auth-card">
        <h1 class="bw-auth-title">{{ __('web.login') }}</h1>
        <p class="bw-auth-subtitle">Welcome back! Please enter your details.</p>

        @include('flash::message')

        <div class="bw-auth-tabs">
            <a href="{{ route('front.candidate.login') }}" class="bw-auth-tab active">{{ __('web.register_menu.candidate') }}</a>
            <a href="{{ route('front.employee.login') }}" class="bw-auth-tab">{{ __('web.register_menu.employer') }}</a>
        </div>

        <form method="POST" action="{{ route('front.login') }}" id="candidateForm">
            @csrf
            <div id="candidateValidationErrBox">
                @include('layouts.errors')
            </div>
            <input type="hidden" name="type" value="1" />
            
            <div class="bw-input-group">
                <label for="email" class="bw-label">{{ __('web.common.email') }} <span class="text-danger">*</span></label>
                <input type="email" class="bw-input" name="email" id="email" value="{{ Cookie::get('email') !== null ? Cookie::get('email') : '' }}" autofocus placeholder="@lang('web.login_menu.enter_email')" required>
            </div>

            <div class="bw-input-group" style="position: relative;">
                <label for="password" class="bw-label">{{ __('web.common.password') }} <span class="text-danger">*</span></label>
                <input type="password" class="bw-input" name="password" id="password" placeholder="@lang('web.login_menu.enter_password')" value="{{ Cookie::get('password') !== null ? Cookie::get('password') : '' }}" required>
                <span class="position-absolute d-flex align-items-center top-50 translate-middle-y {{ getFrontSelectLanguage() == 'ar' ? 'start-0 ms-3' : 'end-0 me-3' }} input-icon input-password-hide cursor-pointer text-gray-600 change-type" style="margin-top: 14px;">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <input type="checkbox" name="remember" id="remember" {{ Cookie::get('remember') !== null ? 'checked' : '' }} style="accent-color: #a100ff;">
                    <label class="bw-checkbox-label" for="remember">{{ __('web.login_menu.remember_me') }}</label>
                </div>
                <a href="{{ route('password.request') }}" class="bw-forgot-link">{{ __('web.login_menu.forget_password') }}</a>
            </div>

            <button type="submit" class="bw-btn mb-4">{{ __('web.login') }}</button>

            <div class="text-center mb-4" style="font-size: 14px; color: #6c6a77;">
                {{ __('web.login_menu.don\'t_have_an_account') }} 
                <a href="{{ route('candidate.register') }}" class="bw-forgot-link" style="font-weight: 700;">{{ __('web.sign_up') }}</a>
            </div>

            @php $envSetting = getEnvSetting(); @endphp
            @if( (!empty($envSetting['facebook_app_id'] || config('services.facebook.client_id')) && !empty($envSetting['facebook_app_secret'] || config('services.facebook.client_secret')) && !empty($envSetting['facebook_redirect'] || config('services.facebook.redirect'))) || (!empty($envSetting['google_client_id'] || config('services.google.client_id')) && !empty($envSetting['google_client_secret'] || config('services.google.client_secret')) && !empty($envSetting['google_redirect'] || config('services.google.redirect'))) || (!empty($envSetting['linkedin_client_id'] || config('services.linkedin-openid.client_id')) && !empty($envSetting['linkedin_client_secret'] || config('services.linkedin-openid.client_secret')) && !empty(config('services.linkedin-openid.redirect'))) )
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                    <div style="flex: 1; height: 1px; background: #e4e2e2;"></div>
                    <span style="font-size: 12px; color: #807287; text-transform: uppercase; font-weight: 600;">Or login with</span>
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
@endsection

{{-- @section('page_scripts') --}}
{{--    <script> --}}
{{--        let registerSaveUrl = "{{ route('front.save.register') }}"; --}}
{{--    </script> --}}
{{--    <script src="{{asset('assets/js/auto_fill/auto_fill.js')}}"></script> --}}
{{-- @endsection --}}
