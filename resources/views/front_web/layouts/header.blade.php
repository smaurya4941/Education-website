<header id="bw-header">
    <div id="bw-header-inner">
        <div style="max-width:1200px; margin:0 auto; padding:0 80px; display:flex; align-items:center; justify-content:space-between; height:100%;">

            {{-- Logo --}}
            <a href="{{ url('/') }}" style="flex-shrink:0; text-decoration:none; display:flex; align-items:center;">
                <img src="{{ getSettingValue('logo') }}" alt="{{ getAppName() }}"
                    style="height:36px; width:auto; object-fit:contain;" />
            </a>

            {{-- Desktop Nav --}}
            <nav id="bw-desktop-nav" style="display:flex; align-items:center; gap:24px; margin-left:auto; margin-right:48px;">

                {{-- Candidate --}}
                <div class="bw-nav-item">
                    <button class="bw-nav-btn {{ Request::is('categories') || Request::is('posts*') || Request::is('pricing') ? 'bw-nav-btn--active' : '' }}" style="font-size:14px; color:#4e4256; padding:0; background:none;">
                        Candidate
                        <span class="material-symbols-outlined bw-chevron" style="font-size:16px;">expand_more</span>
                    </button>
                    <div class="bw-dropdown">
                        <a href="{{ route('front.categories') }}" class="bw-dropdown-item {{ request()->routeIs('front.categories') ? 'bw-dropdown-item--active' : '' }}">
                            <span class="material-symbols-outlined bw-drop-icon">category</span> Jobs By Category
                        </a>
                        <a href="{{ route('front.post.lists') }}" class="bw-dropdown-item {{ request()->routeIs('front.post.lists') ? 'bw-dropdown-item--active' : '' }}">
                            <span class="material-symbols-outlined bw-drop-icon">article</span> Careers Blogs
                        </a>
                        <a href="{{ url('/pricing') }}" class="bw-dropdown-item {{ Request::is('pricing') ? 'bw-dropdown-item--active' : '' }}">
                            <span class="material-symbols-outlined bw-drop-icon">subscriptions</span> Subscriptions
                        </a>
                    </div>
                </div>

                {{-- Employer --}}
                <div class="bw-nav-item">
                    <button class="bw-nav-btn {{ Request::is('employer-register') || Request::is('employer/jobs/create') || Request::is('employer/manage-subscription') ? 'bw-nav-btn--active' : '' }}" style="font-size:14px; color:#4e4256; padding:0; background:none;">
                        Employer
                        <span class="material-symbols-outlined bw-chevron" style="font-size:16px;">expand_more</span>
                    </button>
                    <div class="bw-dropdown">
                        <a href="{{ route('employer.register') }}" class="bw-dropdown-item {{ request()->routeIs('employer.register') ? 'bw-dropdown-item--active' : '' }}">
                            <span class="material-symbols-outlined bw-drop-icon">add_business</span> Start Hiring
                        </a>
                        <a href="{{ Auth::check() ? route('manage-subscription.index') : route('employer.register') }}" class="bw-dropdown-item {{ request()->routeIs('manage-subscription.index') ? 'bw-dropdown-item--active' : '' }}">
                            <span class="material-symbols-outlined bw-drop-icon">subscriptions</span> Subscriptions
                        </a>
                    </div>
                </div>

                {{-- Company --}}
                <div class="bw-nav-item">
                    <button class="bw-nav-btn {{ Request::is('about-us') || Request::is('contact-us') || Request::is('our-team') ? 'bw-nav-btn--active' : '' }}" style="font-size:14px; color:#4e4256; padding:0; background:none;">
                        Company
                        <span class="material-symbols-outlined bw-chevron" style="font-size:16px;">expand_more</span>
                    </button>
                    <div class="bw-dropdown">
                        <a href="{{ route('front.about.us') }}" class="bw-dropdown-item {{ request()->routeIs('front.about.us') ? 'bw-dropdown-item--active' : '' }}">
                            <span class="material-symbols-outlined bw-drop-icon">info</span> About Us
                        </a>
                        <a href="{{ route('front.contact') }}" class="bw-dropdown-item {{ request()->routeIs('front.contact') ? 'bw-dropdown-item--active' : '' }}">
                            <span class="material-symbols-outlined bw-drop-icon">mail</span> Contact Us
                        </a>
                        <a href="{{ url('/our-team') }}" class="bw-dropdown-item {{ Request::is('our-team') ? 'bw-dropdown-item--active' : '' }}">
                            <span class="material-symbols-outlined bw-drop-icon">groups</span> Our Team
                        </a>
                    </div>
                </div>

                {{-- Services --}}
                <a href="{{ route('front.services') }}"
                    class="bw-nav-btn {{ request()->routeIs('front.services') ? 'bw-nav-btn--active' : '' }}"
                    style="text-decoration:none; font-size:14px; color:#4e4256; padding:0; background:none;">Services</a>

                {{-- Language --}}
                <!-- <div class="bw-nav-item">
                    <button class="bw-nav-btn" style="font-size:14px; color:#4e4256; padding:0; background:none;">
                        {{ getCurrentLanguageName() }}
                        <span class="material-symbols-outlined bw-chevron" style="font-size:16px;">expand_more</span>
                    </button>
                    <div class="bw-dropdown" style="right:0; left:auto; min-width:160px;">
                        @foreach (getUserLanguages() as $key => $value)
                            <a href="javascript:void(0)"
                                class="bw-dropdown-item languageSelection {{ checkLanguageSession() == $key ? 'bw-dropdown-item--active' : '' }}"
                                data-prefix-value="{{ $key }}">
                                @if (array_key_exists($key, \App\Models\User::LANGUAGES_IMAGE))
                                    @foreach (\App\Models\User::LANGUAGES_IMAGE as $imageKey => $imageValue)
                                        @if ($imageKey == $key)
                                            <img src="{{ asset($imageValue) }}" class="country-flag"
                                                style="width:20px; height:14px; object-fit:cover; border-radius:2px; margin-right:8px;" />
                                        @endif
                                    @endforeach
                                @else
                                    <i class="fa fa-flag" style="color:#a100ff; margin-right:8px;"></i>
                                @endif
                                {{ $value }}
                            </a>
                        @endforeach
                    </div>
                </div> -->

            </nav>

            {{-- Auth buttons --}}
            <div style="display:flex; align-items:center; gap:16px; flex-shrink:0;">
                @if (!Auth::check())
                    {{-- Login --}}
                    <div class="bw-nav-item">
                        <a href="{{ route('front.candidate.login') }}" style="display:inline-flex; align-items:center; justify-content:center; padding:8px 24px; border:1px solid #807287; border-radius:99px; font-size:14px; font-weight:500; font-family:'Plus Jakarta Sans', sans-serif; color:#4e4256; text-decoration:none; transition:all 0.2s;">
                            Login
                        </a>
                        <div class="bw-dropdown" style="right:0; left:auto; min-width:180px;">
                            <!-- <a href="{{ route('admin.login') }}" class="bw-dropdown-item">
                                <span class="material-symbols-outlined bw-drop-icon">admin_panel_settings</span>
                                @lang('web.admin')
                            </a> -->
                            <a href="{{ route('front.candidate.login') }}" class="bw-dropdown-item">
                                <span class="material-symbols-outlined bw-drop-icon">person</span>
                                {{ __('messages.notification_settings.candidate') }}
                            </a>
                            <a href="{{ route('front.employee.login') }}" class="bw-dropdown-item">
                                <span class="material-symbols-outlined bw-drop-icon">business_center</span>
                                {{ __('messages.company.employer') }}
                            </a>
                        </div>
                    </div>
                    {{-- Register --}}
                    <div class="bw-nav-item">
                        <a href="{{ route('candidate.register') }}" style="display:inline-flex; align-items:center; justify-content:center; padding:9px 24px; background:#a100ff; border-radius:99px; font-size:14px; font-weight:500; font-family:'Plus Jakarta Sans', sans-serif; color:#ffffff; text-decoration:none; transition:all 0.2s;">
                            Register
                        </a>
                        <div class="bw-dropdown" style="right:0; left:auto; min-width:180px;">
                            <a href="{{ route('candidate.register') }}" class="bw-dropdown-item">
                                <span class="material-symbols-outlined bw-drop-icon">person_add</span>
                                {{ __('messages.notification_settings.candidate') }}
                            </a>
                            <a href="{{ route('employer.register') }}" class="bw-dropdown-item">
                                <span class="material-symbols-outlined bw-drop-icon">add_business</span>
                                {{ __('messages.company.employer') }}
                            </a>
                        </div>
                    </div>
                @else
                    {{-- Logged in user --}}
                    <div class="bw-nav-item">
                        <button class="bw-nav-btn" style="gap:10px;">
                            <img src="{{ getLoggedInUser()->avatar }}"
                                style="width:36px; height:36px; border-radius:50%; object-fit:cover; border:2px solid #a100ff;"
                                alt="{{ getLoggedInUser()->full_name }}" />
                            <span style="max-width:120px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; font-size:14px; font-weight:500;">
                                {{ getLoggedInUser()->full_name }}
                            </span>
                            <span class="material-symbols-outlined bw-chevron">expand_more</span>
                        </button>
                        <div class="bw-dropdown" style="right:0; left:auto; min-width:200px;">
                            <a href="{{ dashboardURL() }}" class="bw-dropdown-item">
                                <span class="material-symbols-outlined bw-drop-icon">dashboard</span>
                                {{ __('web.go_to_dashboard') }}
                            </a>
                            @role('Candidate')
                                <a href="{{ route('candidate.profile') }}" class="bw-dropdown-item">
                                    <span class="material-symbols-outlined bw-drop-icon">manage_accounts</span>
                                    {{ __('web.my_profile') }}
                                </a>
                                <a href="{{ route('favourite.jobs') }}" class="bw-dropdown-item">
                                    <span class="material-symbols-outlined bw-drop-icon">favorite</span>
                                    {{ __('messages.favourite_jobs') }}
                                </a>
                                <a href="{{ route('favourite.companies') }}" class="bw-dropdown-item">
                                    <span class="material-symbols-outlined bw-drop-icon">bookmark</span>
                                    {{ __('messages.candidate_dashboard.followings') }}
                                </a>
                                <a href="{{ route('candidate.applied.job') }}" class="bw-dropdown-item">
                                    <span class="material-symbols-outlined bw-drop-icon">task_alt</span>
                                    {{ __('messages.applied_job.applied_jobs') }}
                                </a>
                                <a href="{{ route('candidate.job.alert') }}" class="bw-dropdown-item">
                                    <span class="material-symbols-outlined bw-drop-icon">notifications</span>
                                    {{ __('messages.job.job_alert') }}
                                </a>
                            @endrole
                            @role('Employer')
                                <a href="{{ route('company.edit.form', \Illuminate\Support\Facades\Auth::user()->owner_id) }}" class="bw-dropdown-item">
                                    <span class="material-symbols-outlined bw-drop-icon">manage_accounts</span>
                                    {{ __('web.my_profile') }}
                                </a>
                                <a href="{{ route('job.index') }}" class="bw-dropdown-item">
                                    <span class="material-symbols-outlined bw-drop-icon">work</span>
                                    {{ __('messages.employer_menu.jobs') }}
                                </a>
                                <a href="{{ route('followers.index') }}" class="bw-dropdown-item">
                                    <span class="material-symbols-outlined bw-drop-icon">people</span>
                                    {{ __('messages.employer_menu.followers') }}
                                </a>
                                <a href="{{ route('manage-subscription.index') }}" class="bw-dropdown-item">
                                    <span class="material-symbols-outlined bw-drop-icon">subscriptions</span>
                                    {{ __('messages.employer_menu.manage_subscriptions') }}
                                </a>
                                <a href="{{ route('transactions.index') }}" class="bw-dropdown-item">
                                    <span class="material-symbols-outlined bw-drop-icon">receipt_long</span>
                                    {{ __('messages.employer_menu.transactions') }}
                                </a>
                            @endrole
                            <div style="margin:4px 8px; border-top:1px solid #ede8f5;"></div>
                            <a href="{{ url('logout') }}" class="bw-dropdown-item" style="color:#ba1a1a;"
                                onclick="event.preventDefault(); localStorage.clear(); document.getElementById('logout-form').submit();">
                                <span class="material-symbols-outlined bw-drop-icon" style="color:#ba1a1a;">logout</span>
                                {{ __('web.logout') }}
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                @endif

                {{-- Mobile hamburger --}}
                <button id="bw-mobile-toggle" type="button"
                    style="display:none; background:none; border:none; cursor:pointer; padding:6px; color:#a100ff;">
                    <span class="material-symbols-outlined" style="font-size:28px;">menu</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="bw-mobile-menu" style="display:none; background:#ffffff; border-top:1px solid #ede8f5;">
        <div style="max-width:1200px; margin:0 auto; padding:20px 24px 28px; display:flex; flex-direction:column; gap:4px;">

            <p style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#807287; margin:16px 0 6px; font-family:'Plus Jakarta Sans', sans-serif;">Candidate</p>
            <a href="{{ route('front.categories') }}" style="text-decoration:none; padding:10px 0; font-size:15px; color:#1b1c1c; font-family:'Plus Jakarta Sans', sans-serif; border-bottom:1px solid #f5f3f3;">Jobs By Category</a>
            <a href="{{ route('front.post.lists') }}" style="text-decoration:none; padding:10px 0; font-size:15px; color:#1b1c1c; font-family:'Plus Jakarta Sans', sans-serif; border-bottom:1px solid #f5f3f3;">Careers Blogs</a>
            <a href="{{ url('/pricing') }}" style="text-decoration:none; padding:10px 0; font-size:15px; color:#1b1c1c; font-family:'Plus Jakarta Sans', sans-serif; border-bottom:1px solid #f5f3f3;">Subscriptions</a>

            <p style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#807287; margin:16px 0 6px; font-family:'Plus Jakarta Sans', sans-serif;">Employer</p>
            <a href="{{ route('employer.register') }}" style="text-decoration:none; padding:10px 0; font-size:15px; color:#1b1c1c; font-family:'Plus Jakarta Sans', sans-serif; border-bottom:1px solid #f5f3f3;">Start Hiring</a>
            <a href="{{ Auth::check() ? route('manage-subscription.index') : route('employer.register') }}" style="text-decoration:none; padding:10px 0; font-size:15px; color:#1b1c1c; font-family:'Plus Jakarta Sans', sans-serif; border-bottom:1px solid #f5f3f3;">Subscriptions</a>

            <p style="font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#807287; margin:16px 0 6px; font-family:'Plus Jakarta Sans', sans-serif;">Company</p>
            <a href="{{ route('front.about.us') }}" style="text-decoration:none; padding:10px 0; font-size:15px; color:#1b1c1c; font-family:'Plus Jakarta Sans', sans-serif; border-bottom:1px solid #f5f3f3;">About Us</a>
            <a href="{{ route('front.contact') }}" style="text-decoration:none; padding:10px 0; font-size:15px; color:#1b1c1c; font-family:'Plus Jakarta Sans', sans-serif; border-bottom:1px solid #f5f3f3;">Contact Us</a>
            <a href="{{ url('/our-team') }}" style="text-decoration:none; padding:10px 0; font-size:15px; color:#1b1c1c; font-family:'Plus Jakarta Sans', sans-serif; border-bottom:1px solid #f5f3f3;">Our Team</a>

            <a href="{{ route('front.services') }}" style="text-decoration:none; padding:10px 0; font-size:15px; color:#1b1c1c; font-family:'Plus Jakarta Sans', sans-serif; border-bottom:1px solid #f5f3f3;">Services</a>

            @if (!Auth::check())
                <div style="display:flex; gap:12px; margin-top:20px;">
                    <a href="{{ route('admin.login') }}"
                        style="flex:1; text-align:center; padding:12px; border:1.5px solid #a100ff; border-radius:10px; color:#a100ff; font-size:14px; font-weight:600; text-decoration:none; font-family:'Plus Jakarta Sans', sans-serif;">
                        {{ __('web.login') }}
                    </a>
                    <a href="{{ route('candidate.register') }}"
                        style="flex:1; text-align:center; padding:12px; background:#a100ff; border-radius:10px; color:#ffffff; font-size:14px; font-weight:600; text-decoration:none; font-family:'Plus Jakarta Sans', sans-serif;">
                        {{ __('web.register') }}
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- Mobile Menu Script --}}
    <script>
        document.addEventListener('click', function(e) {
            var toggleBtn = e.target.closest('#bw-mobile-toggle');
            if (toggleBtn) {
                e.preventDefault();
                var mobileMenu = document.getElementById('bw-mobile-menu');
                var icon = toggleBtn.querySelector('.material-symbols-outlined');
                
                if (mobileMenu) {
                    if (typeof jQuery !== 'undefined') {
                        jQuery(mobileMenu).slideToggle(300, function() {
                            if (icon) {
                                icon.textContent = jQuery(mobileMenu).is(':visible') ? 'close' : 'menu';
                            }
                        });
                    } else {
                        if (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') {
                            mobileMenu.style.display = 'block';
                            if (icon) icon.textContent = 'close';
                        } else {
                            mobileMenu.style.display = 'none';
                            if (icon) icon.textContent = 'menu';
                        }
                    }
                }
            }
        });
    </script>
</header>
