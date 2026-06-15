@php
    $settings = settings();
    $lang = session()->get('languageName');
@endphp
<!DOCTYPE html>
<html lang="en" {{ getFrontSelectLanguage() == 'ar' ? 'dir=rtl' : '' }}>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ getAppName() }}</title>
    <link rel="shortcut icon" href="{{ getSettingValue('favicon') }}" type="image/x-icon">
    <link rel="icon" href="{{ getSettingValue('favicon') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('front_web/scss/bootstrap.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="{{ asset('front_web/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">

    <link href="{{ asset('assets/css/front-third-party.css') }}" rel="stylesheet" type="text/css">
    @if (getFrontSelectLanguage() == 'ar')
        <style>
            .notice-section .notice-content span {
                border-radius: 0px 10px 0px 10px !important;
                left: 12px;
                right: auto !important;
            }
            footer .email input {
                border-radius: 0px 10px 10px 0px !important;
            }
            footer .email .icon {
                border-radius: 10px 0px 0px 10px !important;
            }
            header .navbar .navbar-nav .nav-item .submenu {
                right: 0;
            }
            .hero-content-row {
                left: 0% !important;
            }
            .how-it-works-section .work-process .arrow1 {
                right: 24%;
            }
            .how-it-works-section .work-process .arrow2 {
                right: 57%;
            }
            .iti--allow-dropdown .iti__flag-container, .iti--separate-dial-code .iti__flag-container {
                left: auto !important;
                right: 0 !important;
            }
            .mani-blog .blog-card .card-img-top {
                border-radius: 0px 10px 10px 0px !important;
            }
            .select2-container--default .select2-selection--single .select2-selection__arrow {
                left: 10px !important;
            }
            .change-type {
                top: 15%;
                right: 91% !important;
            }
            .change-type-register {
                top: 15% !important;
                right: 83% !important;
            }
            .iti__country-list {
                text-align: right;
            }
            .iti__flag-box, .iti__country-name {
                margin-left: 6px;
            }
            #phoneNumber, #defaultCountryData {
                text-align: end;
                padding-right: 85px;
            }
            .iti--separate-dial-code .iti__selected-dial-code {
                margin-right: 6px;
                margin-left: 0px;
            }
            .iti__arrow {
                margin-right: 6px !important;
                margin-left: 0px;
            }
            .toast-title, .toast-message {
                margin-right: 20px;
            }
            .breadcrumb-item + .breadcrumb-item::before {
                float: right !important;
                padding-left: 0.5rem !important;
                color: #6c757d;
                content: var(--bs-breadcrumb-divider, "/");
            }
        </style>
    @else
        <style>
            .change-type {
                top: 15%;
                left: 91%;
            }
            .change-type-register {
                top: 15% !important;
                left: 83%;
            }
        </style>
    @endif
    <link href="{{ mix('css/front-pages.css') }}" rel="stylesheet" type="text/css">

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
                    "spacing": {
                        "stack-sm": "8px",
                        "stack-md": "16px",
                        "stack-lg": "32px",
                        "stack-xl": "48px",
                        "section-gap": "96px",
                        "gutter": "24px",
                        "margin-mobile": "20px",
                        "margin-desktop": "80px"
                    },
                    "fontFamily": {
                        "body-lg": ["Plus Jakarta Sans"],
                        "display-lg-mobile": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "label-sm": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "display-lg-mobile": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "label-md": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.01em", "fontWeight": "500"}]
                    }
                }
            }
        }
    </script>
    <style>
        /* ============================================================
           BIZWOKE DESIGN SYSTEM — Global Tokens & Components
        ============================================================ */
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

        /* ---- Reset helpers ---- */
        *, *::before, *::after { box-sizing: border-box; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            line-height: 1;
            vertical-align: middle;
            user-select: none;
        }

        /* ============================================================
           HEADER
        ============================================================ */
        #bw-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #ffffff;
            border-bottom: 1px solid var(--bw-outline-variant);
            box-shadow: 0 1px 0 rgba(161,0,255,0.06);
            transition: box-shadow 0.3s, background 0.3s;
        }
        #bw-header.scrolled {
            box-shadow: 0 4px 24px rgba(161,0,255,0.12);
        }
        #bw-header-inner {
            height: 72px;
        }

        /* Nav items & dropdowns */
        .bw-nav-item {
            position: relative;
        }
        .bw-nav-btn {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 8px 14px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            font-family: var(--bw-font);
            color: var(--bw-on-surface-variant);
            border-radius: var(--bw-radius-sm);
            transition: color 0.2s, background 0.2s;
            white-space: nowrap;
            text-decoration: none;
        }
        .bw-nav-btn:hover,
        .bw-nav-btn--active {
            color: var(--bw-primary);
            background: var(--bw-primary-ultra-light);
        }
        .bw-chevron {
            font-size: 16px !important;
            transition: transform 0.25s;
        }
        .bw-nav-item:hover .bw-chevron {
            transform: rotate(180deg);
        }
        .bw-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            min-width: 200px;
            background: #ffffff;
            border: 1px solid var(--bw-outline-variant);
            border-radius: var(--bw-radius-md);
            box-shadow: var(--bw-shadow-lg);
            padding: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px);
            transition: opacity 0.22s ease, transform 0.22s ease, visibility 0.22s;
            z-index: 100;
        }
        .bw-nav-item:hover .bw-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .bw-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            font-size: 14px;
            font-weight: 500;
            font-family: var(--bw-font);
            color: var(--bw-on-surface-variant);
            text-decoration: none;
            border-radius: var(--bw-radius-sm);
            transition: background 0.18s, color 0.18s;
            white-space: nowrap;
        }
        .bw-dropdown-item:hover,
        .bw-dropdown-item--active {
            background: var(--bw-primary-ultra-light);
            color: var(--bw-primary);
        }
        .bw-drop-icon {
            font-size: 18px !important;
            color: var(--bw-primary);
            opacity: 0.7;
        }

        /* Auth buttons */
        .bw-btn-nav-login {
            display: inline-flex;
            align-items: center;
            padding: 9px 22px;
            border: 1.5px solid var(--bw-primary);
            border-radius: 99px;
            font-size: 14px;
            font-weight: 600;
            font-family: var(--bw-font);
            color: var(--bw-primary);
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
            white-space: nowrap;
        }
        .bw-btn-nav-login:hover {
            background: var(--bw-primary-ultra-light);
        }
        .bw-btn-nav-register {
            display: inline-flex;
            align-items: center;
            padding: 9px 22px;
            background: linear-gradient(135deg, var(--bw-primary) 0%, var(--bw-primary-dark) 100%);
            border: none;
            border-radius: 99px;
            font-size: 14px;
            font-weight: 600;
            font-family: var(--bw-font);
            color: #ffffff;
            text-decoration: none;
            box-shadow: 0 4px 16px rgba(161,0,255,0.28);
            transition: opacity 0.2s, transform 0.15s;
            white-space: nowrap;
        }
        .bw-btn-nav-register:hover {
            opacity: 0.88;
            transform: translateY(-1px);
        }

        /* Mobile toggle */
        @media (max-width: 1023px) {
            #bw-desktop-nav { display: none !important; }
            #bw-mobile-toggle { display: flex !important; }
        }

        /* ============================================================
           HERO
        ============================================================ */
        .bw-eyebrow {
            display: block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            color: var(--bw-primary);
            margin-bottom: 14px;
            font-family: var(--bw-font);
        }
        .bw-hero-title {
            font-size: 52px;
            font-weight: 800;
            line-height: 1.12;
            letter-spacing: -0.025em;
            margin-bottom: 22px;
            font-family: var(--bw-font);
        }
        .bw-hero-sub {
            font-size: 18px;
            line-height: 1.7;
            margin-bottom: 40px;
            font-family: var(--bw-font);
        }
        @media (max-width: 768px) {
            .bw-hero-title { font-size: 32px; }
            .bw-hero-sub { font-size: 16px; }
        }

        /* ============================================================
           SECTION HEADINGS
        ============================================================ */
        .bw-section-title {
            font-size: 40px;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.02em;
            color: var(--bw-on-surface);
            margin-bottom: 20px;
            font-family: var(--bw-font);
        }
        @media (max-width: 768px) {
            .bw-section-title { font-size: 28px; }
        }

        /* ============================================================
           BUTTONS
        ============================================================ */
        .bw-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            background: linear-gradient(135deg, var(--bw-primary) 0%, var(--bw-primary-dark) 100%);
            color: #ffffff;
            border: none;
            border-radius: 99px;
            font-size: 15px;
            font-weight: 700;
            font-family: var(--bw-font);
            text-decoration: none;
            box-shadow: 0 6px 24px rgba(161,0,255,0.32);
            cursor: pointer;
            transition: opacity 0.2s, transform 0.18s, box-shadow 0.2s;
        }
        .bw-btn-primary:hover {
            opacity: 0.88;
            transform: translateY(-2px);
            box-shadow: 0 10px 32px rgba(161,0,255,0.40);
            color: #ffffff;
        }
        .bw-btn-outline-white {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            background: rgba(255,255,255,0.10);
            color: #ffffff;
            border: 1.5px solid rgba(255,255,255,0.40);
            border-radius: 99px;
            font-size: 15px;
            font-weight: 700;
            font-family: var(--bw-font);
            text-decoration: none;
            backdrop-filter: blur(4px);
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
        }
        .bw-btn-outline-white:hover {
            background: rgba(255,255,255,0.18);
            border-color: rgba(255,255,255,0.70);
            color: #ffffff;
        }

        /* ============================================================
           STAT CARDS (Get To Know Us grid)
        ============================================================ */
        .bw-stat-card {
            background: #ffffff;
            border: 1px solid var(--bw-outline-variant);
            border-radius: var(--bw-radius-lg);
            padding: 28px 24px;
            text-align: center;
            box-shadow: var(--bw-shadow-sm);
            transition: transform 0.25s, box-shadow 0.25s;
        }
        .bw-stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--bw-shadow-md);
        }
        .bw-stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: var(--bw-primary-ultra-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
        .bw-stat-icon .material-symbols-outlined {
            font-size: 24px;
            color: var(--bw-primary);
        }
        .bw-stat-number {
            font-size: 34px;
            font-weight: 800;
            color: var(--bw-on-surface);
            font-family: var(--bw-font);
            line-height: 1;
            margin-bottom: 6px;
        }
        .bw-stat-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--bw-on-surface-variant);
            font-family: var(--bw-font);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        /* ============================================================
           SERVICE CARDS (Explore What We Do)
        ============================================================ */
        .bw-service-card {
            position: relative;
            display: block;
            border-radius: var(--bw-radius-lg);
            overflow: hidden;
            text-decoration: none;
            aspect-ratio: 3/4;
            background: #1b1c1c;
            box-shadow: var(--bw-shadow-sm);
            transition: transform 0.3s cubic-bezier(0.4,0,0.2,1), box-shadow 0.3s;
        }
        .bw-service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 48px rgba(161,0,255,0.18);
        }
        .bw-service-card-img {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transition: transform 0.5s cubic-bezier(0.4,0,0.2,1);
            background-color: #2d0050;
        }
        .bw-service-card:hover .bw-service-card-img {
            transform: scale(1.08);
        }
        .bw-service-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(10,0,20,0.90) 0%, rgba(10,0,20,0.45) 55%, transparent 100%);
            transition: background 0.3s;
        }
        .bw-service-card:hover .bw-service-card-overlay {
            background: linear-gradient(to top, rgba(10,0,20,0.95) 0%, rgba(10,0,20,0.60) 60%, rgba(161,0,255,0.10) 100%);
        }
        .bw-service-card-body {
            position: absolute;
            inset: 0;
            padding: 28px 24px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }
        .bw-service-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(161,0,255,0.25);
            border: 1px solid rgba(161,0,255,0.40);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
            transform: translateY(8px);
            opacity: 0;
            transition: transform 0.3s, opacity 0.3s;
        }
        .bw-service-icon .material-symbols-outlined {
            font-size: 22px;
            color: #e1b6ff;
        }
        .bw-service-card:hover .bw-service-icon {
            transform: translateY(0);
            opacity: 1;
        }
        .bw-service-title {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            font-family: var(--bw-font);
            margin-bottom: 8px;
            line-height: 1.3;
        }
        .bw-service-desc {
            font-size: 13px;
            color: rgba(255,255,255,0.70);
            font-family: var(--bw-font);
            line-height: 1.6;
            opacity: 0;
            transform: translateY(6px);
            transition: opacity 0.3s 0.05s, transform 0.3s 0.05s;
            margin: 0;
        }
        .bw-service-card:hover .bw-service-desc {
            opacity: 1;
            transform: translateY(0);
        }

        /* ============================================================
           FOOTER
        ============================================================ */
        #bw-footer {
            background: var(--bw-dark-bg);
            color: #a09aad;
            font-family: var(--bw-font);
        }
        .bw-footer-heading {
            font-size: 16px;
            font-weight: 700;
            color: #ffffff;
            font-family: var(--bw-font);
            margin: 0 0 24px;
            letter-spacing: -0.01em;
        }
        .bw-footer-link {
            font-size: 14px;
            font-weight: 500;
            color: #a09aad;
            text-decoration: none;
            font-family: var(--bw-font);
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .bw-footer-link:hover,
        .bw-footer-link--active {
            color: var(--bw-primary);
        }
        .bw-social-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a09aad;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.2s, border-color 0.2s, color 0.2s;
        }
        .bw-social-icon:hover {
            background: var(--bw-primary);
            border-color: var(--bw-primary);
            color: #ffffff;
        }

        /* ============================================================
           RESPONSIVE ADJUSTMENTS
        ============================================================ */
        @media (max-width: 1024px) {
            #bw-header-inner > div,
            #bw-footer > div { padding-left: 32px !important; padding-right: 32px !important; }
            .bw-home > section > div { padding-left: 32px !important; padding-right: 32px !important; }
        }
        @media (max-width: 768px) {
            #bw-footer > div:first-child {
                grid-template-columns: 1fr !important;
            }
            .bw-hero-title { font-size: 32px !important; }
        }
        @media (max-width: 640px) {
            #bw-header-inner > div { padding-left: 20px !important; padding-right: 20px !important; }
        }
    </style>

    @yield('page_css')
    @livewireStyles
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/rappasoft/livewire-tables/css/laravel-livewire-tables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/rappasoft/livewire-tables/css/laravel-livewire-tables-thirdparty.min.css') }}">
    @routes

    @livewireScripts
    <script src="{{ asset('vendor/rappasoft/livewire-tables/js/laravel-livewire-tables.min.js') }}"></script>
	<script src="{{ asset('vendor/rappasoft/livewire-tables/js/laravel-livewire-tables-thirdparty.min.js') }}"></script>

    <script src="{{ mix('js/auth-third-party.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ mix('js/front-third-party.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        let siteKey = "{{ config('app.google_recaptcha_site_key') }}"
    </script>
    {{-- <script src="{{ mix('js/front_pages.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/custom/custom.js') }}"></script> --}}

    @yield('page_scripts')
    @foreach (googleJobSchema() as $jobSchema)
        {!! nl2br($jobSchema) !!}
    @endforeach
    <script src="{{ mix('js/front_pages.js') }}"></script>
</head>

<body {{ $lang == 'pt' || $lang == 'fr' || $lang == 'es' ? 'languages' : '' }}>
    <span class="header-padding"></span>
    @include('front_web.layouts.header')

    @yield('content')

    @if (Request::segment(1) != 'candidate-register' &&
            Request::segment(1) != 'employer-register' &&
            Request::segment(1) != 'users')
        @include('front_web.layouts.footer')
    @endif

    {{ Form::hidden('createNewLetterUrl', route('news-letter.create'), ['id' => 'createNewLetterUrl']) }}
    <script data-turbo-eval="false">
        let defaultCountryCodeValue = "{{ getSettingValue('default_country_code') }}";
        let currentFrontLang = "{{ session()->get('languageName') ?? 'en' }}";
        let lancode = "{{ getFrontSelectLanguage() }}";
        Lang.setLocale(currentFrontLang);
    </script>
     <script src="{{ asset('assets/js/custom/custom.js') }}"></script>
    <script>
        // Header scroll effect
        (function() {
            var header = document.getElementById('bw-header');
            if (!header) return;
            window.addEventListener('scroll', function() {
                if (window.scrollY > 40) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }, { passive: true });
        })();
    </script>

    </body>

</html>
