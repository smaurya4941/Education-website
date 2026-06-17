@php
    $settings = settings();
@endphp
<!DOCTYPE html>
<html lang="en" {{ checkLanguageSession() == 'ar' ? 'dir=rtl' : '' }}>

<head>
    <base href="../">
    <title>@yield('title') | {{ getAppName() }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ getSettingValue('favicon') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
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
        
        .form-control, .form-select, .select2-container--default .select2-selection--single, .select2-container--default .select2-selection--multiple {
            display: block !important;
            width: 100% !important;
            padding: 0.8rem 1.25rem !important;
            font-size: 0.95rem !important;
            font-weight: 500 !important;
            line-height: 1.5 !important;
            color: #1b1c1c !important;
            background-color: #fff !important;
            background-clip: padding-box !important;
            border: 1.5px solid #ede8f5 !important;
            appearance: none !important;
            border-radius: 12px !important;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            box-shadow: 0 1px 2px rgba(161,0,255,0.02) !important;
            height: auto !important;
        }
        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23807287' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e") !important;
            background-repeat: no-repeat !important;
            background-position: right 1.25rem center !important;
            background-size: 16px 12px !important;
            padding-right: 2.5rem !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #1b1c1c !important;
            line-height: 1.5 !important;
            padding: 0 !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100% !important;
            right: 1.25rem !important;
        }
        .form-control:focus, .form-select:focus, .select2-container--open .select2-selection {
            color: #1b1c1c !important;
            background-color: #fff !important;
            border-color: #a100ff !important;
            outline: 0 !important;
            box-shadow: 0 0 0 4px rgba(161,0,255,0.1) !important;
        }
        .form-control::placeholder {
            color: #a097a8 !important;
            opacity: 1 !important;
        }
        .form-label {
            margin-bottom: 0.5rem !important;
            font-size: 0.9rem !important;
            font-weight: 700 !important;
            color: #4e4256 !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
        .required::after {
            content: "*" !important;
            color: #ef4444 !important;
            margin-left: 4px !important;
        }
        .btn-primary {
            color: #fff !important;
            background-color: #a100ff !important;
            border-color: #a100ff !important;
            border-radius: 12px !important;
            padding: 0.75rem 2rem !important;
            font-weight: 700 !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            transition: all 0.2s !important;
            box-shadow: 0 4px 12px rgba(161,0,255,0.2) !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        .btn-primary:hover {
            background-color: #8e00e2 !important;
            border-color: #8e00e2 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 16px rgba(161,0,255,0.25) !important;
        }
        .btn-light, .btn-secondary {
            color: #4e4256 !important;
            background-color: #faf7ff !important;
            border-color: #ede8f5 !important;
            border-radius: 12px !important;
            padding: 0.75rem 2rem !important;
            font-weight: 700 !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            transition: all 0.2s !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        .btn-light:hover, .btn-secondary:hover {
            background-color: #ede8f5 !important;
        }
        .btn-success {
            color: #fff !important;
            background-color: #10b981 !important;
            border-color: #10b981 !important;
            border-radius: 12px !important;
            padding: 0.75rem 2rem !important;
            font-weight: 700 !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            transition: all 0.2s !important;
            box-shadow: 0 4px 12px rgba(16,185,129,0.2) !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        .btn-success:hover {
            background-color: #059669 !important;
            border-color: #059669 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 16px rgba(16,185,129,0.25) !important;
        }
    </style>
    @stack('css')
    @livewireStyles
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/rappasoft/livewire-tables/css/laravel-livewire-tables.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/rappasoft/livewire-tables/css/laravel-livewire-tables-thirdparty.min.css') }}">

    @routes
    @livewireScripts

	<script src="{{ asset('vendor/rappasoft/livewire-tables/js/laravel-livewire-tables.min.js') }}"></script>
	<script src="{{ asset('vendor/rappasoft/livewire-tables/js/laravel-livewire-tables-thirdparty.min.js') }}"></script>


        @if (checkLanguageSession() == 'ar')
            <style>
                .horizontal-sidebar .horizontal-menu .nav-item .nav-link .horizontal-menu-icon {
                    padding-left: .625rem;
                }
                .modal-header .btn-close {
                    margin: -0.9375rem -0.9375rem -0.9375rem -0.9375rem !important;
                }
                .table.table-striped > :not(caption) > * > * , .table.table-striped > thead > tr > th{
                    padding: 0.625rem 1.875rem 0.625rem 0.25rem !important;
                    vertical-align: middle;
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
                #phoneNumber, #defaultCountryData {
                    text-align: end;
                    padding-right: 85px
                }
                .iti--allow-dropdown .iti__flag-container, .iti--separate-dial-code .iti__flag-container {
                    right: 0;
                    left: auto;
                }
                #phone{
                    text-align: end;
                }
                .ql-editor {
                    direction: rtl;
                    text-align: right;
                }
                .iti__country-list {
                    text-align: right;
                }
                .iti__flag-box, .iti__country-name {
                    margin-left: 6px;
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
<script src="{{ mix('js/third-party.js') }}"></script>
<script src="{{ mix('js/pages.js') }}"></script>

<body class="overflow-x-hidden bg-gray-50/50">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-column-fluid">
            <div class="header fixed-header bg-white border-b border-gray-100 shadow-sm !h-[72px] !flex !items-center">
                @include('candidate.layouts.header')
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
            @include('candidate_profile.edit_profile_modal')
            @include('candidate_profile.change_password_modal')
        </div>
    </div>
    <script data-turbo-eval="false">
        var hostUrl = 'assets/';
        let getLoggedInUserLang = '{{ getCurrentLanguageCode() }}';
        let defaultCountryCodeValue = "{{ getSettingValue('default_country_code') }}"
        Lang.setLocale(getLoggedInUserLang)
    </script>
    @stack('scripts')
</body>

</html>
