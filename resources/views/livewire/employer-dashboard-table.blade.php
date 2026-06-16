<div class="content flex-column-fluid">
    <div class="container-fluid container-xxl">
        <div class="row">
            <!--begin::Col-->
            <div class="col-xl-6 {{ checkLanguageSession() == 'ar' ? 'pe-0' : 'ps-0' }}">
                <!--begin::Tables Widget 1-->
                <div class="mb-xl-8">
                    <!--begin::Header-->
                    <div class="d-flex align-items-center justify-content-between border-b border-[#ede8f5] pb-4 mb-4">
                        <h3 class="m-0">
                            <span class="text-xl font-extrabold text-[#1b1c1c] font-['Plus_Jakarta_Sans']">{{ __('messages.employer_menu.recent_jobs') }}</span>
                        </h3>
                        <!--begin::Menu-->
                        <span>
                            <a href="{{ route('job.index') }}"
                                class="inline-flex items-center gap-1.5 px-5 py-2 bg-gradient-to-br from-[#a100ff] to-[#7000b0] text-white rounded-full text-[13px] font-bold shadow-[0_4px_16px_rgba(161,0,255,0.28)] hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(161,0,255,0.36)] hover:text-white transition-all duration-300 no-underline font-['Plus_Jakarta_Sans']">
                                {{ __('messages.common.view_more') }}
                                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </a>
                        </span>
                        <!--end::Menu-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive ">
                            <!--begin::Table-->
                            <table class="table table-striped align-middle gs-0 gy-5">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="{{ checkLanguageSession() == 'ar' ? 'text-end' : 'text-start' }} text-[#807287] text-[11px] font-bold uppercase tracking-[0.1em] font-['Plus_Jakarta_Sans'] border-b border-[#ede8f5] gs-0">
                                        <th class="pb-3">{{ __('messages.job.job_title') }}</th>
                                        <th class="pb-3">{{ __('messages.employer_menu.expires_on') }}</th>
                                        <th class="pb-3 text-center">{{ __('messages.common.status') }}</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-[#4e4256] font-medium font-['Plus_Jakarta_Sans']">
                                    @if (count($recentJobs) > 0)
                                        @foreach ($recentJobs as $recentJob)
                                            <tr>
                                                <td class="ps-3 py-4">
                                                    <a href="{{ route('front.job.details', $recentJob->job_id) }}"
                                                        class="text-[#1b1c1c] font-bold hover:text-[#a100ff] transition-colors no-underline"
                                                        >{{ html_entity_decode($recentJob->job_title) }}</a>
                                                </td>
                                                <td>
                                                    {{ Carbon\Carbon::parse($recentJob->job_expiry_date)->translatedFormat('jS M, Y') }}
                                                </td>
                                                <td class="text-center">
                                                    <div
                                                        class="badge w-auto bg-{{ \App\Models\Job::STATUS_COLOR[$recentJob->status] }}">
                                                            @php
                                                                $status = \App\Models\Job::STATUS[$recentJob->status];
                                                            @endphp
                                                            <span>{{ getTranslatedData($status)[0] }}</span>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                </div>
                <!--endW::Tables Widget 1-->
            </div>
            <!--end::Col-->
            <div class="col-xl-6 {{ checkLanguageSession() == 'ar' ? 'ps-0' : 'pe-0' }}">
                <!--begin::Tables Widget 1-->
                <div class="mb-xl-8">
                    <!--begin::Header-->
                    <div class="d-flex align-items-center justify-content-between border-b border-[#ede8f5] pb-4 mb-4">
                        <h3 class="m-0">
                            <span class="text-xl font-extrabold text-[#1b1c1c] font-['Plus_Jakarta_Sans']">{{ __('messages.employer_menu.recent_follower') }}</span>
                        </h3>
                        <!--begin::Menu-->
                        <span>
                            <a href="{{ route('followers.index') }}"
                                class="inline-flex items-center gap-1.5 px-5 py-2 bg-gradient-to-br from-[#a100ff] to-[#7000b0] text-white rounded-full text-[13px] font-bold shadow-[0_4px_16px_rgba(161,0,255,0.28)] hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(161,0,255,0.36)] hover:text-white transition-all duration-300 no-underline font-['Plus_Jakarta_Sans']">
                                {{ __('messages.common.view_more') }}
                                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </a>
                        </span>
                        <!--end::Menu-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive ">
                            <!--begin::Table-->
                            <table class="table table-striped align-middle gs-0 gy-5">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="{{ checkLanguageSession() == 'ar' ? 'text-end' : 'text-start' }} text-[#807287] text-[11px] font-bold uppercase tracking-[0.1em] font-['Plus_Jakarta_Sans'] border-b border-[#ede8f5] gs-0">
                                        <th class="pb-3">{{ __('messages.company.candidate_name') }}</th>
                                        <th class="pb-3">{{ __('messages.company.candidate_phone') }}</th>
                                        <th class="pb-3 text-center">{{ __('messages.company.candidate_email') }}</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-[#4e4256] font-medium font-['Plus_Jakarta_Sans']">
                                    @if (count($recentFollowers) > 0)
                                        @foreach ($recentFollowers as $recentFollower)
                                            <tr>
                                                <td class="ps-3 py-4 text-[#1b1c1c] font-bold">
                                                    {{ html_entity_decode($recentFollower->user->full_name) }}
                                                </td>
                                                <td>
                                                    {{ empty($recentFollower->user->phone) ? __('messages.n/a') : $recentFollower->user->phone }}
                                                </td>
                                                <td class="{{ checkLanguageSession() == 'ar' ? 'text-start' : 'text-end' }}">
                                                    {{ $recentFollower->user->email }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                <span>{{ __('messages.employer_menu.no_data_available') }}.</span>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                </div>
                <!--endW::Tables Widget 1-->
            </div>

        </div>
    </div>
</div>
