@extends('front_web.layouts.app')
@section('title')
    {{ __('messages.employer_menu.manage_subscriptions') }}
@endsection
@section('content')
    <!-- Premium Pricing Section -->
    <section class="relative bg-[#fbf9f9] pt-24 pb-28 overflow-hidden font-['Plus_Jakarta_Sans']">
        <!-- Abstract Background Blobs -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <div class="absolute top-[-10%] left-[5%] w-[600px] h-[600px] bg-[#e1b6ff] rounded-full mix-blend-multiply filter blur-[120px] opacity-40"></div>
            <div class="absolute top-[20%] right-[-5%] w-[500px] h-[500px] bg-[#eaccfe] rounded-full mix-blend-multiply filter blur-[100px] opacity-40"></div>
        </div>

        <div class="w-full relative z-10 mx-auto px-4 max-w-[1240px]">
            <div class="text-center max-w-2xl mx-auto mb-20">
                <span class="block text-[12px] font-bold uppercase tracking-[0.2em] text-[#a100ff] mb-4">Pricing Plans</span>
                <h1 class="text-4xl md:text-5xl lg:text-[52px] font-extrabold text-[#1b1c1c] tracking-tight mb-6 leading-[1.15]">
                    Simple, transparent pricing
                </h1>
                <p class="text-[18px] text-[#4e4256] font-medium leading-[1.7]">
                    Choose the perfect plan to scale your hiring. No hidden fees.
                </p>
            </div>

            <!-- Pricing Grid (4 columns) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($plans as $plan)
                    @php
                        // Highlight the second plan, or any plan named 'Premium' / 'Standard'
                        $isPopular = $loop->index == 1; 
                    @endphp
                    <div class="relative bg-white rounded-[24px] p-8 transition-all duration-300 flex flex-col {{ $isPopular ? 'border-[2px] border-[#a100ff] shadow-[0_12px_40px_rgba(161,0,255,0.18)] lg:scale-105 z-10' : 'border border-[#d1c1d8] shadow-[0_4px_20px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_30px_rgba(161,0,255,0.12)] hover:-translate-y-1' }}">
                        
                        @if($isPopular)
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2">
                                <span class="bg-[#a100ff] text-white text-[12px] font-bold uppercase tracking-[0.08em] py-1.5 px-4 rounded-full shadow-[0_4px_12px_rgba(161,0,255,0.3)] whitespace-nowrap">
                                    Most Popular
                                </span>
                            </div>
                        @endif

                        <!-- Plan Title & Price -->
                        <div class="text-center mb-8 mt-2">
                            <h3 class="text-[22px] font-bold text-[#1b1c1c] mb-5">{{ html_entity_decode($plan->name) }}</h3>
                            <div class="flex items-end justify-center gap-1">
                                <span class="text-[44px] font-extrabold text-[#a100ff] leading-[1]">
                                    {{ empty($plan->salaryCurrency->currency_icon) ? '$' : $plan->salaryCurrency->currency_icon }}{{ $plan->amount }}
                                </span>
                                <span class="text-[15px] font-medium text-[#807287] mb-1.5">
                                    / {{ $plan->unlimited_plan == 1 ? 'Unlimited' : 'Month' }}
                                </span>
                            </div>
                        </div>

                        <!-- Features List -->
                        <ul class="space-y-4 mb-10 flex-1">
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-[#a100ff] mt-0.5 text-[22px]">check_circle</span>
                                <span class="text-[15px] font-medium text-[#4e4256] leading-tight pt-1">
                                    <strong class="text-[#1b1c1c]">{{ $plan->allowed_jobs }}</strong> {{ $plan->allowed_jobs > 1 ? __('messages.plan.jobs_allowed') : __('messages.plan.job_allowed') }}
                                </span>
                            </li>
                            <li class="flex items-start gap-3">
                                @if ($plan->is_trial_plan)
                                    <span class="material-symbols-outlined text-[#a100ff] mt-0.5 text-[22px]">check_circle</span>
                                    <span class="text-[15px] font-medium text-[#4e4256] leading-tight pt-1">{{ __('messages.plan.is_trial_plan') }}</span>
                                @else
                                    <span class="material-symbols-outlined text-[#d1c1d8] mt-0.5 text-[22px]">cancel</span>
                                    <span class="text-[15px] font-medium text-[#807287] line-through opacity-70 leading-tight pt-1">{{ __('messages.plan.is_trial_plan') }}</span>
                                @endif
                            </li>
                            <!-- Premium feel mock feature -->
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-[#a100ff] mt-0.5 text-[22px]">check_circle</span>
                                <span class="text-[15px] font-medium text-[#4e4256] leading-tight pt-1">
                                    Premium support
                                </span>
                            </li>
                        </ul>

                        <!-- Action Button -->
                        <div class="mt-auto">
                            @if(!Auth::check())
                                <a href="{{ route('employer.register') }}" 
                                   class="block w-full py-[14px] px-6 text-[15px] text-center rounded-[99px] font-bold transition-all duration-200 {{ $isPopular ? 'bg-gradient-to-br from-[#a100ff] to-[#7000b0] text-white shadow-[0_6px_24px_rgba(161,0,255,0.32)] hover:shadow-[0_10px_32px_rgba(161,0,255,0.4)] hover:-translate-y-0.5' : 'bg-[#f2daff] text-[#a100ff] hover:bg-[#a100ff] hover:text-white' }}">
                                    Get Started
                                </a>
                            @elseif(Auth::user()->hasRole('Employer'))
                                @if($plan->is_trial_plan)
                                    <button disabled 
                                       class="block w-full py-[14px] px-6 text-[15px] text-center rounded-[99px] font-bold transition-all duration-200 opacity-50 cursor-not-allowed {{ $isPopular ? 'bg-gradient-to-br from-[#a100ff] to-[#7000b0] text-white' : 'bg-[#f2daff] text-[#a100ff]' }}">
                                        Trial Plan
                                    </button>
                                @else
                                    <a href="{{ route('payment-method-screen', $plan->id) }}" 
                                       class="block w-full py-[14px] px-6 text-[15px] text-center rounded-[99px] font-bold transition-all duration-200 {{ $isPopular ? 'bg-gradient-to-br from-[#a100ff] to-[#7000b0] text-white shadow-[0_6px_24px_rgba(161,0,255,0.32)] hover:shadow-[0_10px_32px_rgba(161,0,255,0.4)] hover:-translate-y-0.5' : 'bg-[#f2daff] text-[#a100ff] hover:bg-[#a100ff] hover:text-white' }}">
                                        {{ __('messages.plan.purchase') }}
                                    </a>
                                @endif
                            @else
                                <a href="javascript:void(0)" onclick="alert('Only employers can purchase subscription plans. Please log out and register as an employer to continue.')" 
                                   class="block w-full py-[14px] px-6 text-[15px] text-center rounded-[99px] font-bold transition-all duration-200 {{ $isPopular ? 'bg-gradient-to-br from-[#a100ff] to-[#7000b0] text-white shadow-[0_6px_24px_rgba(161,0,255,0.32)] hover:shadow-[0_10px_32px_rgba(161,0,255,0.4)] hover:-translate-y-0.5' : 'bg-[#f2daff] text-[#a100ff] hover:bg-[#a100ff] hover:text-white' }}">
                                    Get Started
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
    </section>
@endsection
