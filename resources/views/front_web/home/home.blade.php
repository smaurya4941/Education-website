@extends('front_web.layouts.app')

@section('title')
    {{ __('web.home') }}
@endsection

@section('page_css')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css">
    <style>
        .hero-bg {
            background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(255,255,255,0.95) 40%, rgba(255,255,255,0) 100%);
        }
        @media (max-width: 768px) {
            .hero-bg {
                background: rgba(255,255,255,0.9);
            }
        }
    </style>
@endsection

@section('content')
<div class="bw-home">

    {{-- ============================================================
         HERO SECTION
    ============================================================ --}}
    <section style="position:relative; min-height:600px; display:flex; align-items:center; background-color:#f9f9f9;">
        {{-- Background image --}}
        <div style="position:absolute; top:0; right:0; bottom:0; width:70%; z-index:0;">
            @if ($settings->value != 0 && count($headerSliders) > 0)
                <img src="{{ $headerSliders[0]->header_slider_url }}" alt="Hero Background slider"
                    style="width:100%; height:100%; object-fit:cover; object-position:right;">
            @elseif (!empty($cmsServices['home_banner']))
                <img src="{{ asset($cmsServices['home_banner']) }}" alt="Hero Background banner"
                    style="width:100%; height:100%; object-fit:cover; object-position:right;">
            @else
                <img src="{{ asset('front_web/images/hero-img.png') }}" alt="Hero Background"
                    style="width:100%; height:100%; object-fit:cover; object-position:right;">
            @endif
        </div>
        
        {{-- Gradient overlay --}}
        <div class="hero-bg" style="position:absolute; inset:0; z-index:1;"></div>
        
        {{-- Content --}}
        <div style="position:relative; z-index:2; width:100%; max-width:1200px; margin:0 auto; padding:0 80px;">
            <div style="max-width:550px;">
                <h1 style="font-size:48px; font-weight:800; line-height:1.2; color:#1b1c1c; margin-bottom:24px; font-family:'Plus Jakarta Sans', sans-serif;">
                    Discover <span style="color:#a100ff;">Best Guru in</span><br>
                    <span style="color:#a100ff;">Education</span>
                </h1>
                <p style="font-size:16px; line-height:1.6; color:#4e4256; margin-bottom:0; font-family:'Plus Jakarta Sans', sans-serif;">
                    Connecting World-Class Educators to Exceptional Opportunities across the Middle East's premier educational landscape.
                </p>
            </div>
        </div>
    </section>

    {{-- ============================================================
         SEARCH SECTION
    ============================================================ --}}
    <section style="background:#f9f9f9; padding:0 0 60px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 80px;">
            <div style="background:#ffffff; border-radius:12px; box-shadow:0 10px 40px rgba(0,0,0,0.05); padding:40px; margin-top:-80px; position:relative; z-index:10;">
                <div style="display:flex; align-items:center; gap:8px; margin-bottom:24px;">
                    <span style="font-size:14px; font-weight:500; color:#4e4256; font-family:'Plus Jakarta Sans', sans-serif;">Search candidate database</span>
                    <span class="material-symbols-outlined" style="color:#a100ff; font-size:18px;">info</span>
                </div>
                <form action="{{ route('front.search.jobs') }}" id="searchForm" method="get">
                    <div style="display:flex; gap:24px; align-items:flex-end; flex-wrap:wrap;">
                        {{-- Job Title --}}
                        <div style="flex:1; min-width:250px;">
                            <label for="searchJobTitle" style="display:block; font-size:12px; font-weight:600; text-transform:uppercase; color:#807287; margin-bottom:12px; font-family:'Plus Jakarta Sans', sans-serif;">Select Job Title</label>
                            <div style="position:relative;">
                                <select name="keywords" id="searchJobTitle"
                                    style="width:100%; padding:14px 40px 14px 20px; border-radius:8px; border:1px solid #e4e2e2; background:#f5f3f3; font-size:14px; color:#4e4256; appearance:none; cursor:pointer; font-family:'Plus Jakarta Sans', sans-serif; outline:none;">
                                    <option value="">Eg: Mathematics Teacher</option>
                                    <option>English Teacher</option>
                                    <option>Physics Lecturer</option>
                                    <option>School Principal</option>
                                </select>
                                <span class="material-symbols-outlined" style="position:absolute; right:14px; top:50%; transform:translateY(-50%); color:#807287; font-size:18px; pointer-events:none;">unfold_more</span>
                            </div>
                            <div id="jobsSearchResults" class="position-absolute w-100 job-search" style="display:none;">
                                <ul class="job-search-dropdown nav submenu"></ul>
                            </div>
                        </div>
                        {{-- City --}}
                        <div style="flex:1; min-width:250px;">
                            <label for="searchCity" style="display:block; font-size:12px; font-weight:600; text-transform:uppercase; color:#807287; margin-bottom:12px; font-family:'Plus Jakarta Sans', sans-serif;">Select City</label>
                            <div style="position:relative;">
                                <select name="location" id="searchCity"
                                    style="width:100%; padding:14px 40px 14px 20px; border-radius:8px; border:1px solid #e4e2e2; background:#f5f3f3; font-size:14px; color:#4e4256; appearance:none; cursor:pointer; font-family:'Plus Jakarta Sans', sans-serif; outline:none;">
                                    <option value="">Pick Your City</option>
                                    <option>Abu Dhabi</option>
                                    <option>Dubai</option>
                                    <option>Sharjah</option>
                                </select>
                                <span class="material-symbols-outlined" style="position:absolute; right:14px; top:50%; transform:translateY(-50%); color:#807287; font-size:18px; pointer-events:none;">unfold_more</span>
                            </div>
                        </div>
                        {{-- Search button --}}
                        <div style="flex-shrink:0;">
                            <button type="submit"
                                style="width:50px; height:50px; background:#a100ff; color:#fff; border:none; border-radius:8px; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:background 0.2s;">
                                <span class="material-symbols-outlined" style="font-size:24px;">search</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- ============================================================
         GET TO KNOW US SECTION
    ============================================================ --}}
    <section style="background:#ffffff; padding:80px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 80px; text-align:center;">
            <span style="display:block; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.1em; color:#a100ff; margin-bottom:16px; font-family:'Plus Jakarta Sans', sans-serif;">About Bizwoke</span>
            <h2 style="font-size:36px; font-weight:800; color:#1b1c1c; margin-bottom:40px; font-family:'Plus Jakarta Sans', sans-serif;">Get To Know Us</h2>
            
            <div style="max-width:800px; margin:0 auto;">
                <p style="font-size:15px; line-height:1.8; color:#6c6a77; margin-bottom:24px; font-family:'Plus Jakarta Sans', sans-serif;">
                    Bizwoke is a boutique student centred company specialising in education consultancy, professional development, teacher recruitment, the design and furnishing of modern educational spaces for students.
                </p>
                <p style="font-size:15px; line-height:1.8; color:#6c6a77; margin-bottom:0; font-family:'Plus Jakarta Sans', sans-serif;">
                    Our team consists of educators, project managers, designers, consultants and school leaders who all have previous experience in the field of education and are driven by one mission – to create student centred learning environments that stimulate and inspire.
                </p>
            </div>
        </div>
    </section>

    {{-- ============================================================
         EXPLORE WHAT WE DO
    ============================================================ --}}
    <section style="background:#f9f9f9; padding:80px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 80px;">
            <div style="text-align:center; margin-bottom:48px;">
                <span style="display:block; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.1em; color:#a100ff; margin-bottom:16px; font-family:'Plus Jakarta Sans', sans-serif;">Our Expertise</span>
                <h2 style="font-size:36px; font-weight:800; color:#1b1c1c; margin-bottom:0; font-family:'Plus Jakarta Sans', sans-serif;">Explore What We Do</h2>
            </div>
            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px;">

                @foreach ($branding as $brand)
                <a href="{{ url('/services') }}" style="position:relative; display:block; border-radius:12px; overflow:hidden; aspect-ratio:3/4; text-decoration:none; background:#ccc;">
                    <img src="{{ $brand->branding_slider_url }}" alt="{{ $brand->title }}" style="width:100%; height:100%; object-fit:cover;">
                    <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%);"></div>
                    <div style="position:absolute; bottom:0; left:0; right:0; padding:20px;">
                        <h3 style="font-size:16px; font-weight:600; color:#ffffff; font-family:'Plus Jakarta Sans', sans-serif; margin:0; line-height:1.4;">{{ $brand->title }}</h3>
                    </div>
                </a>
                @endforeach

            </div>
        </div>
    </section>

    {{-- ============================================================
         WHO WE WORK WITH — PARTNERS
    ============================================================ --}}
    @if (count($headerSliders) > 0)
        <section style="background:#f0f0f0; padding:80px 0;">
            <div style="max-width:1200px; margin:0 auto; padding:0 80px;">
                <p style="text-align:center; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.1em; color:#807287; margin-bottom:40px; font-family:'Plus Jakarta Sans', sans-serif;">Who We Work With</p>
                <div style="display:flex; justify-content:center; gap:24px; flex-wrap:wrap;">
                    {{-- Groups of 4 or 5 logos per white card to match design --}}
                    @php $chunks = collect($headerSliders)->chunk(4); @endphp
                    @foreach ($chunks as $chunk)
                        <div style="background:#ffffff; border-radius:8px; padding:24px; display:grid; grid-template-columns:1fr 1fr; gap:16px; align-items:center; justify-items:center; width:300px; box-shadow:0 4px 12px rgba(0,0,0,0.03);">
                            @foreach ($chunk as $slider)
                                <img src="{{ $slider->header_slider_url }}" alt="Partner Logo" style="max-width:100px; max-height:40px; object-fit:contain;" />
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Hidden form field for home data --}}
    {{ Form::hidden('homeData', json_encode(getCountries()), ['id' => 'indexHomeData']) }}

</div>
@endsection
