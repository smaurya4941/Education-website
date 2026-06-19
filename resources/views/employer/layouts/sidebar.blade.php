<div class="w-full p-4 lg:p-0">
    <ul class="flex flex-col lg:flex-row items-stretch lg:items-center gap-2 m-0 p-0 list-none">
        
        {{-- Dashboard --}}
        <li class="nav-item list-none m-0">
            <a class="flex items-center gap-2 text-sm font-semibold px-3 py-2.5 rounded-lg transition-all no-underline whitespace-nowrap {{ Request::is('employer/dashboard*') ? 'text-[#a100ff] bg-purple-50' : 'text-gray-600 hover:text-[#a100ff] hover:bg-gray-50' }}"
               href="{{ route('employer.dashboard') }}">
                <span class="material-symbols-outlined text-lg shrink-0">dashboard</span>
                <span>{{ __('messages.dashboard') }}</span>
            </a>
        </li>

        {{-- Employer Profile --}}
        <li class="nav-item list-none m-0">
            <a class="flex items-center gap-2 text-sm font-semibold px-3 py-2.5 rounded-lg transition-all no-underline whitespace-nowrap {{ \Illuminate\Support\Facades\Route::is('company.edit.form') ? 'text-[#a100ff] bg-purple-50' : 'text-gray-600 hover:text-[#a100ff] hover:bg-gray-50' }}"
               href="{{ route('company.edit.form', \Illuminate\Support\Facades\Auth::user()->owner_id) }}">
                <span class="material-symbols-outlined text-lg shrink-0">domain</span>
                <span>{{ __('messages.employer_menu.employer_profile') }}</span>
            </a>
        </li>

        {{-- Jobs --}}
        <li class="nav-item list-none m-0">
            <a class="flex items-center gap-2 text-sm font-semibold px-3 py-2.5 rounded-lg transition-all no-underline whitespace-nowrap {{ Request::is('employer/jobs*') ? 'text-[#a100ff] bg-purple-50' : 'text-gray-600 hover:text-[#a100ff] hover:bg-gray-50' }}"
               href="{{ route('job.index') }}">
                <span class="material-symbols-outlined text-lg shrink-0">work</span>
                <span>{{ __('messages.employer_menu.jobs') }}</span>
            </a>
        </li>

        {{-- Job Stages --}}
        <li class="nav-item list-none m-0">
            <a class="flex items-center gap-2 text-sm font-semibold px-3 py-2.5 rounded-lg transition-all no-underline whitespace-nowrap {{ Request::is('employer/job-stage*') ? 'text-[#a100ff] bg-purple-50' : 'text-gray-600 hover:text-[#a100ff] hover:bg-gray-50' }}"
               href="{{ route('job.stage.index') }}">
                <span class="material-symbols-outlined text-lg shrink-0">layers</span>
                <span>{{ __('messages.job_stages') }}</span>
            </a>
        </li>

        {{-- Followers --}}
        <li class="nav-item list-none m-0">
            <a class="flex items-center gap-2 text-sm font-semibold px-3 py-2.5 rounded-lg transition-all no-underline whitespace-nowrap {{ Request::is('employer/followers*') ? 'text-[#a100ff] bg-purple-50' : 'text-gray-600 hover:text-[#a100ff] hover:bg-gray-50' }}"
               href="{{ route('followers.index') }}">
                <span class="material-symbols-outlined text-lg shrink-0">group</span>
                <span>{{ __('messages.employer_menu.followers') }}</span>
            </a>
        </li>

        {{-- Transactions --}}
        <li class="nav-item list-none m-0">
            <a class="flex items-center gap-2 text-sm font-semibold px-3 py-2.5 rounded-lg transition-all no-underline whitespace-nowrap {{ Request::is('employer/transactions*') || Request::is('employer/transaction*') ? 'text-[#a100ff] bg-purple-50' : 'text-gray-600 hover:text-[#a100ff] hover:bg-gray-50' }}"
               href="{{ route('transactions.index') }}">
                <span class="material-symbols-outlined text-lg shrink-0">receipt_long</span>
                <span>{{ __('messages.employer_menu.transactions') }}</span>
            </a>
        </li>

        {{-- Subscriptions --}}
        <li class="nav-item list-none m-0">
            <a class="flex items-center gap-2 text-sm font-semibold px-3 py-2.5 rounded-lg transition-all no-underline whitespace-nowrap {{ Request::is('employer/manage-subscription*') ? 'text-[#a100ff] bg-purple-50' : 'text-gray-600 hover:text-[#a100ff] hover:bg-gray-50' }}"
               href="{{ route('manage-subscription.index') }}">
                <span class="material-symbols-outlined text-lg shrink-0">card_membership</span>
                <span>{{ __('messages.employer_menu.manage_subscriptions') }}</span>
            </a>
        </li>

    </ul>
</div>
