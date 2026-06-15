<!DOCTYPE html>
<html lang="en" {{ checkLanguageSession() == 'ar' ? 'dir=rtl' : '' }}>
<!--begin::Head-->
<head>
    @include('google_analytics')
    <base href="../">
    <title>@yield('title') | {{ getAppName() }}</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
    @if(getLoggedInUser()->theme_mode)
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-dark.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.dark.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.dark.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
        @endif
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    
    {{-- Tailwind CSS with Bizwoke Design Tokens --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-primary-container": "#f9e8ff",
                        "tertiary-fixed-dim": "#c8c5d3",
                        "on-surface": "#1b1c1c",
                        "surface-variant": "#e4e2e2",
                        "inverse-surface": "#303031",
                        "primary-container": "#a100ff",
                        "outline": "#807287",
                        "on-secondary-container": "#6b547e",
                        "surface": "#fbf9f9",
                        "surface-container-highest": "#e4e2e2",
                        "secondary-fixed": "#f1daff",
                        "background": "#fbf9f9",
                        "on-background": "#1b1c1c",
                        "tertiary-fixed": "#e4e0ef",
                        "primary-fixed-dim": "#e1b6ff",
                        "tertiary": "#53525e",
                        "on-primary": "#ffffff",
                        "surface-tint": "#8e00e2",
                        "primary": "#a100ff",
                        "surface-container-high": "#e9e8e7",
                        "outline-variant": "#d1c1d8",
                        "on-tertiary-fixed-variant": "#474551",
                        "surface-container-lowest": "#ffffff",
                        "secondary": "#6d557f",
                        "surface-dim": "#dbdad9",
                        "on-error": "#ffffff",
                        "secondary-container": "#eaccfe",
                        "on-surface-variant": "#4e4256",
                        "tertiary-container": "#6c6a77",
                        "on-primary-fixed-variant": "#6c00ae",
                        "inverse-primary": "#e1b6ff",
                        "secondary-fixed-dim": "#d9bced",
                        "on-secondary": "#ffffff",
                        "primary-fixed": "#f2daff",
                        "on-error-container": "#93000a",
                        "error-container": "#ffdad6",
                        "on-tertiary": "#ffffff",
                        "surface-container": "#efeded",
                        "inverse-on-surface": "#f2f0f0",
                        "on-secondary-fixed": "#261238",
                        "surface-container-low": "#f5f3f3",
                        "on-tertiary-container": "#f0ecfb",
                        "surface-bright": "#fbf9f9",
                        "on-tertiary-fixed": "#1b1a25",
                        "on-secondary-fixed-variant": "#543d66",
                        "on-primary-fixed": "#2e004e",
                        "error": "#ba1a1a"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.8rem",
                        "xl": "1rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "sans": ["Plus Jakarta Sans", "Inter", "sans-serif"]
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --bw-primary: #a100ff;
            --bw-primary-dark: #7000b0;
            --bw-primary-light: #f2daff;
            --bw-primary-ultra-light: #faf7ff;
            --bw-on-primary: #ffffff;
            --bw-surface: #ffffff;
            --bw-surface-low: #f5f3f3;
            --bw-on-surface: #1b1c1c;
            --bw-on-surface-variant: #4e4256;
            --bw-outline: #807287;
            --bw-outline-variant: #d1c1d8;
            --bw-dark-bg: #1a0028;
            --bw-font: 'Plus Jakarta Sans', 'Inter', sans-serif;
            --bw-radius-sm: 8px;
            --bw-radius-md: 12px;
            --bw-radius-lg: 16px;
            --bw-radius-xl: 24px;
            --bw-shadow-sm: 0 2px 8px rgba(0,0,0,0.06);
            --bw-shadow-md: 0 4px 20px rgba(161,0,255,0.10), 0 2px 8px rgba(0,0,0,0.06);
            --bw-shadow-lg: 0 12px 40px rgba(161,0,255,0.18), 0 4px 12px rgba(0,0,0,0.08);
        }
        body {
            font-family: var(--bw-font);
        }
    </style>
    @livewireStyles
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/rappasoft/livewire-tables/css/laravel-livewire-tables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/rappasoft/livewire-tables/css/laravel-livewire-tables-thirdparty.min.css') }}">

    @routes
    @livewireScripts
    <script src="{{ asset('vendor/rappasoft/livewire-tables/js/laravel-livewire-tables.min.js') }}"></script>
	<script src="{{ asset('vendor/rappasoft/livewire-tables/js/laravel-livewire-tables-thirdparty.min.js') }}"></script>

        @if (checkLanguageSession() == 'ar')
            <style>
                .daterangepicker{
                    left: 355px !important;
                    right: auto !important;
                }
                .modal-header .btn-close {
                    margin: -0.9375rem -0.9375rem -0.9375rem -0.9375rem !important;
                }
                .horizontal-sidebar .horizontal-menu .nav-item .nav-link .horizontal-menu-icon {
                    padding-left: .625rem;
                }
                .iti--allow-dropdown .iti__flag-container, .iti--separate-dial-code .iti__flag-container {
                    right: 0;
                    left: auto;
                }
                #phoneNumber, #defaultCountryData {
                    text-align: end;
                    padding-right: 85px
                }
                .ql-editor {
                    direction: rtl;
                    text-align: right;
                }
                .input-group.has-validation>.dropdown-toggle:nth-last-child(n+4), .input-group.has-validation>:nth-last-child(n+3):not(.dropdown-toggle):not(.dropdown-menu), .input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3), .input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu) {
                    border-bottom-left-radius: 0;
                    border-top-left-radius: 0;
                    border-bottom-right-radius: 5px;
                    border-top-right-radius: 5px;
                }
                .input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
                    border-bottom-right-radius: 0;
                    border-top-right-radius: 0;
                    border-bottom-left-radius: 5px;
                    border-top-left-radius: 5px;
                }
                .table.table-striped > :not(caption) > * > * , .table.table-striped > thead > tr > th{
                    padding: 0.625rem 1.875rem 0.625rem 0.25rem !important;
                    vertical-align: middle;
                }
                .toast-title, .toast-message {
                    margin-right: 20px;
                }
            </style>
        @endif
</head>
<script data-turbo-eval="false">
    let lancode = "{{ checkLanguageSession() }}";
</script>
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ mix('js/third-party.js') }}"></script>
<script src="{{ mix('js/pages.js') }}"></script>
<body class="overflow-x-hidden bg-gray-50/50">
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-column-fluid">
        <div class="header fixed-header bg-white border-b border-gray-100 shadow-sm !h-[72px] !flex !items-center">
            @include('employer.layouts.header')
        </div>
        <div class="theme-wrapper d-flex flex-column flex-row-fluid">
            <div class='d-flex flex-column flex-row-fluid'>
                <div class="d-flex flex-column flex-column-fluid pt-7">
                    <div class="content flex-column-fluid">
                        <div class="container-fluid container-xxl">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='container-fluid container-xxl'>
            @include('layouts.footer')
        </div>
        @include('employer_profile.edit_profile_modal')
        @include('employer_profile.change_password_modal')
    </div>
</div>
{{Form::hidden('employerProfileData',true,['id'=>'indexEmployerProfileData'])}}
{{Form::hidden('default-image-url', asset('assets/img/infyom-logo.png'), ['id' => 'defaultImageUrl'])}}
<script data-turbo-eval="false">
    var hostUrl = 'assets/';
    let getLoggedInUserLang = '{{getCurrentLanguageCode()}}';
    let defaultCountryCodeValue = "{{ getSettingValue('default_country_code')}}";
    Lang.setLocale(getLoggedInUserLang);
</script>
<script>
    $(document).ready(function () {
        $('.alert').delay(5000).slideUp(300);
    });
    var stripe = '';
    @if(!empty(getEnvSetting()['stripe_key']))
         stripe = Stripe('{{ getEnvSetting()['stripe_key'] }}');
    @elseif(config('services.stripe.key'))
        stripe = Stripe('{{config('services.stripe.key')}}');
    @endif

    //fix menu overflow under the responsive table
    // hide menu on click... (This is a must because when we open a menu )
    $(document).click(function (event) {
        //hide all our dropdowns
        $('.dropdown-menu[data-parent]').hide();
    });

    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "unset");
    }).on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    })

</script>
@stack('scripts')
</body>
</html>
