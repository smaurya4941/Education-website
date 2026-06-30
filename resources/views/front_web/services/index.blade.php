@extends('front_web.layouts.app')

@section('title')
    {{ __('web.services') ?? 'Services' }}
@endsection

@section('page_css')
    <style>
        .hero-bg {
            background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(255,255,255,0.95) 40%, rgba(255,255,255,0) 100%);
        }
        @media (max-width: 768px) {
            .hero-bg {
                background: rgba(255,255,255,0.9);
            }
            .why-choose-us-container {
                flex-direction: column !important;
                gap: 40px !important;
            }
            .services-grid {
                grid-template-columns: 1fr !important;
            }
        }
        @media (min-width: 769px) and (max-width: 1024px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }
    </style>
@endsection

@section('content')
<div class="bw-services">

    {{-- HERO SECTION --}}
    <section style="position:relative; min-height:450px; display:flex; align-items:center; background-color:#f9f9f9;">
        <div style="position:absolute; top:0; right:0; bottom:0; width:70%; z-index:0;">
            @if (!empty($cmsServices['home_banner']))
                <img src="{{ asset($cmsServices['home_banner']) }}" alt="Services Hero"
                    style="width:100%; height:100%; object-fit:cover; object-position:right;">
            @else
                <img src="{{ asset('front_web/images/hero-img.png') }}" alt="Services Hero"
                    style="width:100%; height:100%; object-fit:cover; object-position:right;">
            @endif
        </div>
        <div class="hero-bg" style="position:absolute; inset:0; z-index:1;"></div>
        <div style="position:relative; z-index:2; width:100%; max-width:1200px; margin:0 auto; padding:0 80px;">
            <div style="max-width:600px;">
                <h1 style="font-size:48px; font-weight:800; line-height:1.2; color:#1b1c1c; margin-bottom:24px; font-family:'Plus Jakarta Sans', sans-serif;">
                    Our <span style="color:#a100ff;">Services</span>
                </h1>
                <p style="font-size:16px; line-height:1.6; color:#4e4256; margin-bottom:0; font-family:'Plus Jakarta Sans', sans-serif;">
                    We offer a variety of services tailored to meet your unique educational and staffing needs. Discover what Bizwoke can do for you.
                </p>
            </div>
        </div>
    </section>

    {{-- SERVICES LISTING --}}
    <section style="background:#ffffff; padding:80px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 80px;">
            <div style="text-align:center; margin-bottom:56px;">
                <span style="display:block; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.1em; color:#a100ff; margin-bottom:16px; font-family:'Plus Jakarta Sans', sans-serif;">Our Expertise</span>
                <h2 style="font-size:36px; font-weight:800; color:#1b1c1c; margin-bottom:0; font-family:'Plus Jakarta Sans', sans-serif;">Explore What We Do</h2>
            </div>
            
            <div class="services-grid" style="display:grid; grid-template-columns:repeat(3,1fr); gap:32px;">
                @foreach ($branding as $brand)
                <div style="position:relative; display:flex; flex-direction:column; background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 10px 40px rgba(0,0,0,0.06); transition:transform 0.3s, box-shadow 0.3s;" 
                     onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 50px rgba(0,0,0,0.1)';" 
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 40px rgba(0,0,0,0.06)';">
                    <div style="aspect-ratio:16/10; position:relative; background:#f5f3f3;">
                        <img src="{{ $brand->branding_slider_url }}" alt="{{ $brand->title }}" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div style="padding:32px 24px; flex-grow:1; display:flex; flex-direction:column;">
                        <h3 style="font-size:20px; font-weight:700; color:#1b1c1c; font-family:'Plus Jakarta Sans', sans-serif; margin-bottom:16px;">{{ $brand->title }}</h3>
                        <p style="font-size:15px; line-height:1.6; color:#6c6a77; font-family:'Plus Jakarta Sans', sans-serif; margin-bottom:24px; flex-grow:1;">
                            {{ $brand->description ?? 'Expertly designed solutions for your educational and staffing requirements, ensuring quality outcomes and success.' }}
                        </p>
                        <a href="{{ route('front.contact') }}" style="align-self:flex-start; text-decoration:none; font-size:14px; font-weight:600; color:#a100ff; font-family:'Plus Jakarta Sans', sans-serif; display:flex; align-items:center; gap:8px;">
                            Enquire Now <span class="material-symbols-outlined" style="font-size:18px;">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            @if(count($branding) === 0)
                <div style="text-align:center; padding:60px 0; color:#807287; font-family:'Plus Jakarta Sans', sans-serif;">
                    <span class="material-symbols-outlined" style="font-size:48px; margin-bottom:16px; opacity:0.5;">inventory_2</span>
                    <p style="font-size:16px;">No services currently listed. Please check back later.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- WHY CHOOSE US --}}
    <section style="background:#f9f9f9; padding:100px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 80px;">
            <div class="why-choose-us-container" style="display:flex; flex-direction:row; align-items:center; gap:80px;">
                <div style="flex:1;">
                    <span style="display:block; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.1em; color:#a100ff; margin-bottom:16px; font-family:'Plus Jakarta Sans', sans-serif;">Why Bizwoke</span>
                    <h2 style="font-size:36px; font-weight:800; color:#1b1c1c; margin-bottom:24px; font-family:'Plus Jakarta Sans', sans-serif;">We bring the right people together.</h2>
                    <p style="font-size:16px; line-height:1.8; color:#6c6a77; font-family:'Plus Jakarta Sans', sans-serif; margin-bottom:40px;">
                        Our specialised focus on education ensures that whether you're a school seeking leadership or a teacher seeking a new classroom, we understand the specific challenges and nuances of your environment.
                    </p>
                    <div style="display:flex; flex-direction:column; gap:24px;">
                        <div style="display:flex; align-items:flex-start; gap:20px;">
                            <div style="width:56px; height:56px; border-radius:16px; background:rgba(161,0,255,0.08); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                <span class="material-symbols-outlined" style="color:#a100ff; font-size:28px;">psychology</span>
                            </div>
                            <div>
                                <h4 style="font-size:18px; font-weight:700; color:#1b1c1c; font-family:'Plus Jakarta Sans', sans-serif; margin-bottom:8px;">Industry Expertise</h4>
                                <p style="font-size:15px; line-height:1.6; color:#6c6a77; font-family:'Plus Jakarta Sans', sans-serif; margin:0;">Deep roots in the education sector allow us to make perfect matches between talent and opportunity.</p>
                            </div>
                        </div>
                        <div style="display:flex; align-items:flex-start; gap:20px;">
                            <div style="width:56px; height:56px; border-radius:16px; background:rgba(161,0,255,0.08); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                <span class="material-symbols-outlined" style="color:#a100ff; font-size:28px;">verified</span>
                            </div>
                            <div>
                                <h4 style="font-size:18px; font-weight:700; color:#1b1c1c; font-family:'Plus Jakarta Sans', sans-serif; margin-bottom:8px;">Quality Assured</h4>
                                <p style="font-size:15px; line-height:1.6; color:#6c6a77; font-family:'Plus Jakarta Sans', sans-serif; margin:0;">Rigorous vetting processes to guarantee the highest standard of educational professionals.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="flex:1; position:relative;">
                    <div style="position:absolute; inset:0; background:#a100ff; border-radius:24px; transform:translate(24px, 24px); z-index:0;"></div>
                    @if (!empty($cmsServices['about_image_one']))
                        <img src="{{ asset($cmsServices['about_image_one']) }}" alt="Why choose us" style="width:100%; height:auto; border-radius:24px; position:relative; z-index:1; box-shadow:0 10px 40px rgba(0,0,0,0.1); aspect-ratio:4/3; object-fit:cover;">
                    @else
                        <img src="{{ asset('front_web/images/hero-img.png') }}" alt="Why choose us" style="width:100%; height:auto; border-radius:24px; position:relative; z-index:1; box-shadow:0 10px 40px rgba(0,0,0,0.1); aspect-ratio:4/3; object-fit:cover;">
                    @endif
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
