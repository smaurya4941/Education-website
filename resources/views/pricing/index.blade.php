@extends('employer.layouts.app')
@section('title')
    {{ __('messages.employer_menu.manage_subscriptions') }}
@endsection
@section('content')
    <!-- Inject Tailwind with Preflight Disabled to avoid breaking Bootstrap -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: {
                preflight: false,
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    @include('flash::message')
    
    <!-- Premium Pricing Section -->
    <section class="relative bg-[#fbf9f9] pt-[40px] pb-[60px] overflow-hidden font-['Plus_Jakarta_Sans'] rounded-[24px] shadow-sm mt-[20px] border border-[#e4e2e2]">
        <!-- Abstract Background Blobs -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0 rounded-[24px]">
            <div class="absolute top-[-10%] left-[5%] w-[600px] h-[600px] bg-[#e1b6ff] rounded-full mix-blend-multiply filter blur-[120px] opacity-30"></div>
            <div class="absolute top-[20%] right-[-5%] w-[500px] h-[500px] bg-[#eaccfe] rounded-full mix-blend-multiply filter blur-[100px] opacity-30"></div>
        </div>

        <div class="w-full relative z-10 mx-auto px-[16px] max-w-[1240px]">
            <div class="text-center max-w-2xl mx-auto mb-[32px]">
                <span class="block text-[12px] font-bold uppercase tracking-[0.2em] text-[#a100ff] mb-[12px]">Manage Subscription</span>
                <h1 class="text-4xl md:text-[36px] font-extrabold text-[#1b1c1c] tracking-tight mb-[12px] leading-[1.15] m-0">
                    Your active plans
                </h1>
                <p class="text-[15px] text-[#4e4256] font-medium leading-[1.6] m-0">
                    View your current limits, upgrade to higher tiers, or renew your subscription.
                </p>
            </div>

            <!-- Pricing Grid (4 columns) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-[24px]">
                @foreach ($plans as $plan)
                    @php
                        $isActive = isset($subscription) && $subscription->plan_id == $plan->id;
                        // Determine if we should highlight this card
                        // If user has active plan, highlight that. Otherwise, highlight the second plan like the public page.
                        $isPopular = isset($subscription) ? $isActive : ($loop->index == 1);
                    @endphp
                    <div class="relative bg-white rounded-[24px] p-6 transition-all duration-300 flex flex-col {{ $isPopular ? 'border-[2px] border-[#a100ff] shadow-[0_12px_40px_rgba(161,0,255,0.18)] lg:scale-[1.02] z-10' : 'border border-[#d1c1d8] shadow-[0_4px_20px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_30px_rgba(161,0,255,0.12)] hover:-translate-y-1' }}">
                        
                        @if($isActive)
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2">
                                <span class="bg-[#28a745] text-white text-[11px] font-bold uppercase tracking-[0.08em] py-1.5 px-4 rounded-full shadow-[0_4px_12px_rgba(40,167,69,0.3)] whitespace-nowrap">
                                    Current Plan
                                </span>
                            </div>
                        @elseif($isPopular && !isset($subscription))
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2">
                                <span class="bg-[#a100ff] text-white text-[11px] font-bold uppercase tracking-[0.08em] py-1.5 px-4 rounded-full shadow-[0_4px_12px_rgba(161,0,255,0.3)] whitespace-nowrap">
                                    Recommended
                                </span>
                            </div>
                        @endif

                        <!-- Plan Title & Price -->
                        <div class="text-center mb-6 mt-2">
                            <h3 class="text-[20px] font-bold text-[#1b1c1c] mb-4 m-0">{{ html_entity_decode($plan->name) }}</h3>
                            <div class="flex items-end justify-center gap-1">
                                <span class="text-[38px] font-extrabold text-[#a100ff] leading-[1]">
                                    {{ empty($plan->salaryCurrency->currency_icon) ? '$' : $plan->salaryCurrency->currency_icon }}{{ $plan->amount }}
                                </span>
                                <span class="text-[14px] font-medium text-[#807287] mb-1.5">
                                    / {{ $plan->unlimited_plan == 1 ? 'Unlimited' : 'Month' }}
                                </span>
                            </div>
                        </div>

                        <!-- Active Plan Details -->
                        @if ($isActive && $subscription->stripe_status != 'trialing')
                            <div class="bg-[#f2daff] rounded-[12px] p-3 mb-6 text-center border border-[#e1b6ff]">
                                <span class="block text-[13px] font-bold text-[#6c00ae] uppercase tracking-wider mb-1">Status</span>
                                <span class="text-[14px] font-semibold text-[#2e004e]">
                                    @if (isset($subscription->ends_at))
                                        {{ __('messages.plan.ends_at') . ': ' . \Carbon\Carbon::parse($subscription->ends_at)->translatedFormat('jS M,Y') }}
                                    @else
                                        {{ __('messages.plan.renews_on') . ': ' . \Carbon\Carbon::parse($subscription->current_period_end)->translatedFormat('jS M,Y') }}
                                    @endif
                                </span>
                            </div>
                        @endif

                        <!-- Features List -->
                        <ul class="space-y-4 mb-8 flex-1 p-0 m-0 list-none">
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-[#a100ff] mt-0.5 text-[20px]">check_circle</span>
                                <span class="text-[14px] font-medium text-[#4e4256] leading-tight pt-0.5">
                                    <strong class="text-[#1b1c1c]">{{ $plan->allowed_jobs }}</strong> {{ $plan->allowed_jobs > 1 ? __('messages.plan.jobs_allowed') : __('messages.plan.job_allowed') }}
                                </span>
                            </li>
                            <li class="flex items-start gap-3">
                                @if ($plan->is_trial_plan)
                                    <span class="material-symbols-outlined text-[#a100ff] mt-0.5 text-[20px]">check_circle</span>
                                    <span class="text-[14px] font-medium text-[#4e4256] leading-tight pt-0.5">{{ __('messages.plan.is_trial_plan') }}</span>
                                @else
                                    <span class="material-symbols-outlined text-[#d1c1d8] mt-0.5 text-[20px]">cancel</span>
                                    <span class="text-[14px] font-medium text-[#807287] line-through opacity-70 leading-tight pt-0.5">{{ __('messages.plan.is_trial_plan') }}</span>
                                @endif
                            </li>
                            
                            @if ($isActive)
                                <li class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-[#28a745] mt-0.5 text-[20px]">work</span>
                                    <span class="text-[14px] font-bold text-[#1b1c1c] leading-tight pt-0.5">
                                        {{ $jobsCount . ' ' . ($jobsCount > 1 ? __('messages.plan.jobs_used') : __('messages.plan.job_used')) }}
                                    </span>
                                </li>
                            @endif
                        </ul>

                        <!-- Action Buttons -->
                        <div class="mt-auto flex flex-col gap-3">
                            @if ($isActive)
                                @if ($subscription->current_period_end <= date('Y-m-d H:i:s'))
                                    <a href="{{ route('payment-method-screen', $plan->id) }}"
                                        data-id="{{ $plan->id }}"
                                        class="block w-full py-3 px-4 text-[14px] text-center rounded-[99px] font-bold transition-all duration-200 bg-[#ffc107] text-[#1b1c1c] hover:bg-[#e0a800] hover:text-[#1b1c1c] shadow-sm">
                                        {{ __('messages.plan.upgrade') }}
                                    </a>
                                @else
                                    <div class="block w-full py-3 px-4 text-[14px] text-center rounded-[99px] font-bold bg-[#28a745] text-white cursor-default shadow-sm">
                                        {{ __('messages.plan.current_plan') }}
                                    </div>
                                @endif

                                @if ($subscription->stripe_status != 'trialing')
                                    @if (isset($subscription->ends_at))
                                        <div class="block w-full py-2.5 px-4 text-[13px] text-center rounded-[99px] font-bold bg-[#f8d7da] text-[#721c24] cursor-default border border-[#f5c6cb]">
                                            {{ __('messages.plan.subscription_cancelled') }}
                                        </div>
                                    @else
                                        @if ($subscription['name'] != 'Trial Plan')
                                            <a href="javascript:void(0)"
                                                class="block w-full py-2.5 px-4 text-[13px] text-center rounded-[99px] font-bold transition-all duration-200 bg-white border border-[#dc3545] text-[#dc3545] hover:bg-[#dc3545] hover:text-white cancel-subscription">
                                                {{ __('messages.plan.cancel_subscription') }}
                                            </a>
                                        @endif
                                    @endif
                                @endif
                            @else
                                @if ($plan->is_trial_plan)
                                    <button disabled
                                        class="block w-full py-3 px-4 text-[14px] text-center rounded-[99px] font-bold transition-all duration-200 bg-[#f5f3f3] text-[#807287] cursor-not-allowed border border-[#e4e2e2]">
                                        {{ __('messages.plan.is_trial_plan') }}
                                    </button>
                                @elseif(!empty(processingPlan($plan->id)))
                                    <div class="block w-full py-3 px-4 text-[14px] text-center rounded-[99px] font-bold bg-[#e4e2e2] text-[#4e4256] cursor-default">
                                        {{ __('messages.plan.processing') }}
                                    </div>
                                @else
                                    @if ($activePlanId !== $plan->id)
                                        <a href="{{ route('payment-method-screen', $plan->id) }}"
                                            data-id="{{ $plan->id }}"
                                            class="block w-full py-3 px-4 text-[14px] text-center rounded-[99px] font-bold transition-all duration-200 {{ $isPopular ? 'bg-gradient-to-br from-[#a100ff] to-[#7000b0] text-white shadow-[0_4px_16px_rgba(161,0,255,0.3)] hover:shadow-[0_6px_20px_rgba(161,0,255,0.4)] hover:-translate-y-0.5' : 'bg-[#f2daff] text-[#a100ff] hover:bg-[#a100ff] hover:text-white' }}">
                                            {{ __('messages.plan.purchase') }}
                                        </a>
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            @include('pricing.cancel_subscription_modal')
        </div>
    </section>
    
    {{ Form::hidden('subscribe-text', __('messages.plan.purchase'), ['id' => 'subscribeText']) }}
@endsection
