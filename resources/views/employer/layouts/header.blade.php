@php($notifications = getNotification(\App\Models\Notification::EMPLOYER))
@php($notificationCount = $notifications->count())

<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-[72px] flex items-center justify-between">
    
    {{-- Left Side: Logo & Navigation --}}
    <div class="flex items-center gap-4">
        {{-- Logo --}}
        <a href="{{ route('front.home') }}" target="_blank" class="flex items-center gap-3 no-underline">
            <div class="w-9 h-9 rounded-lg bg-purple-50 flex items-center justify-center overflow-hidden">
                <img src="{{ getLogoUrl() }}" class="max-h-8 w-auto object-contain" alt="{{ getAppName() }}">
            </div>
        </a>
        
        {{-- Desktop Navigation Menu --}}
        <nav class="hidden lg:flex items-center" id="nav-header">
            @include('employer.layouts.sidebar')
        </nav>
        
    </div>

    {{-- Right Side: Actions & Profile --}}
    <div class="flex items-center gap-2">
        
        {{-- Dark Mode Toggle --}}
        <a href="{{ route('theme.mode') }}" class="w-10 h-10 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-50 hover:text-[#a100ff] transition-all">
            <span class="material-symbols-outlined text-2xl">
                {{ getLoggedInUser()->theme_mode ? 'light_mode' : 'dark_mode' }}
            </span>
        </a>

        {{-- Notifications Dropdown --}}
        <div class="dropdown relative">
            <button class="dropdown-toggle w-10 h-10 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-50 hover:text-[#a100ff] transition-all relative border-0 bg-transparent"
                    type="button" id="notificationDropdownBtn"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <span class="material-symbols-outlined text-2xl">notifications</span>
                @if($notificationCount > 0)
                    <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 border-2 border-white rounded-full" id="counter"></span>
                @endif
            </button>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow-xl rounded-xl p-0 w-80 bg-white mt-2" aria-labelledby="notificationDropdownBtn" style="margin: 0;">
                <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-gray-900">{{__('messages.notification.notifications')}}</h3>
                    @if($notificationCount > 0)
                        <span class="px-2 py-0.5 bg-red-50 text-red-600 rounded-full text-xs font-semibold">{{ $notificationCount }} New</span>
                    @endif
                </div>
                <div class="max-h-72 overflow-y-auto divide-y divide-gray-50">
                    @if($notificationCount > 0)
                        @foreach($notifications as $notification)
                            <div class="p-4 flex gap-3 hover:bg-gray-50 transition-all cursor-pointer readNotification"
                                 data-id="{{ $notification->id }}">
                                <div class="w-8 h-8 rounded-full bg-purple-50 flex items-center justify-center text-[#a100ff] shrink-0">
                                    <i class="{{ getNotificationIcon($notification->type) }} text-xs"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs font-medium text-gray-900 truncate">{{ $notification->title }}</p>
                                    <p class="text-[10px] text-gray-400 mt-0.5">
                                        {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans(null, true) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="p-6 text-center text-gray-500">
                            <span class="material-symbols-outlined text-4xl text-gray-300 mb-2">notifications_off</span>
                            <p class="text-xs font-medium">{{ __('messages.notification.empty_notifications') }}</p>
                        </div>
                    @endif
                </div>
                @if($notificationCount > 0)
                    <div class="p-3 border-t border-gray-100 text-center">
                        <button class="text-xs font-bold text-[#a100ff] hover:text-[#7000b0] bg-transparent border-0 cursor-pointer"
                                id="readAllNotification">
                            {{ __('messages.notification.mark_all_as_read') }}
                        </button>
                    </div>
                @endif
            </div>
        </div>

        {{-- Profile Dropdown --}}
        <div class="dropdown relative">
            <button class="dropdown-toggle flex items-center gap-2 pr-3 pl-0 py-1.5 rounded-lg border-0 bg-transparent hover:bg-gray-50 text-gray-700 transition-all" type="button"
                    id="profileDropdownBtn" data-bs-auto-close="outside"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ Auth::user()->company->company_url }}"
                     class="w-8 h-8 rounded-full object-cover border-2 border-[#a100ff]" alt="profile image">
                <span class="material-symbols-outlined text-gray-400 text-lg hidden md:block">expand_more</span>
            </button>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow-xl rounded-xl p-0 w-64 bg-white mt-2" aria-labelledby="profileDropdownBtn"
                 data-bs-auto-close="outside" style="margin: 0;">
                <div class="p-4 border-b border-gray-100 text-center">
                    <img src="{{ getLoggedInUser()->avatar }}" class="w-16 h-16 rounded-full object-cover mx-auto border-2 border-purple-100 mb-2" alt="profile image">
                    <h3 class="text-sm font-bold text-gray-900">{{ Auth::user()->full_name }}</h3>
                    <p class="text-xs text-gray-400 mt-0.5 truncate">{{ Auth::user()->email }}</p>
                </div>
                <div class="p-2 divide-y divide-gray-50">
                    <div class="py-1">
                        <a href="javascript:void(0)" class="flex items-center gap-3 px-3 py-2 text-xs font-medium text-gray-700 hover:bg-purple-50 hover:text-[#a100ff] rounded-lg no-underline editProfileModal"
                           data-id="{{ getLoggedInUserId() }}">
                            <span class="material-symbols-outlined text-lg text-gray-400">person</span>
                            {{ __('messages.user.edit_profile') }}
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2 text-xs font-medium text-gray-700 hover:bg-purple-50 hover:text-[#a100ff] rounded-lg no-underline changePasswordModal"
                           href="javascript:void(0)" data-id="{{ getLoggedInUserId() }}">
                            <span class="material-symbols-outlined text-lg text-gray-400">lock</span>
                            {{ __('messages.user.change_password') }}
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2 text-xs font-medium text-gray-700 hover:bg-purple-50 hover:text-[#a100ff] rounded-lg no-underline changeLanguageModal"
                           href="javascript:void(0)" data-id="{{ getLoggedInUserId() }}">
                            <span class="material-symbols-outlined text-lg text-gray-400">translate</span>
                            {{ __('messages.user_language.change_language') }}
                        </a>
                    </div>
                    <div class="py-1">
                        <a class="flex items-center gap-3 px-3 py-2 text-xs font-medium text-red-600 hover:bg-red-50 rounded-lg no-underline" href="{{ url('logout') }}"
                           onclick="event.preventDefault(); localStorage.clear(); document.getElementById('logout-form').submit();">
                            <span class="material-symbols-outlined text-lg text-red-400">logout</span>
                            {{ __('messages.user.logout') }}
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mobile Menu Toggle --}}
        <button type="button" class="w-10 h-10 rounded-lg flex lg:hidden items-center justify-center text-gray-500 hover:bg-gray-50 hover:text-[#a100ff] transition-all border-0 bg-transparent horizontal-menubar">
            <span class="material-symbols-outlined text-2xl">menu</span>
        </button>
    </div>
</div>
<div class="bg-overlay" id="horizontal-menubar-overly"></div>
