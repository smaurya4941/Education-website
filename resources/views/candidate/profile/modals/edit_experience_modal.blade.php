<div id="editExperienceModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content border-0 rounded-[24px] shadow-[0_12px_40px_rgba(161,0,255,0.15)] bg-white overflow-hidden">
            <div class="modal-header border-b border-[#ede8f5] bg-[#faf7ff] px-8 py-5">
                <h3 class="modal-title text-[22px] font-bold text-[#1b1c1c] font-['Plus_Jakarta_Sans'] m-0 flex items-center gap-3">
                    <span class="w-10 h-10 rounded-full bg-white text-[#a100ff] flex items-center justify-center border border-[#e1b6ff] shadow-sm">
                        <i class="fas fa-briefcase"></i>
                    </span>
                    {{ __('messages.candidate_profile.edit_experience') }}
                </h3>
                <button type="button" class="btn-close m-0 opacity-50 hover:opacity-100 transition-opacity" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editExperienceForm', 'class' => 'm-0']) }}
            <div class="modal-body px-8 py-6 bg-white">
                <div class="alert alert-danger hide d-none rounded-xl" id="editValidationErrorsBox">
                    <i class='fa-solid fa-face-frown me-4'></i>
                </div>
                {{ Form::hidden('experienceId',null,['id'=>'experienceId']) }}
                <div class="row">
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('experience_title',__('messages.candidate_profile.experience_title').(':'), ['class' => 'form-label text-[#4e4256] font-bold text-[14px] mb-2']) }}
                        <span class="required text-red-500">*</span>
                        {{ Form::text('experience_title', null, ['class' => 'form-control !rounded-xl !border-[#ede8f5] focus:!border-[#a100ff] focus:!ring-[#a100ff] !text-[#1b1c1c] !bg-white px-4 py-3 shadow-sm transition-all','required','id' => 'editTitle','placeholder'=>__('messages.candidate_profile.experience_title')]) }}
                    </div>
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('company',__('messages.candidate_profile.company').(':'),['class' => 'form-label text-[#4e4256] font-bold text-[14px] mb-2']) }}
                        <span class="required text-red-500">*</span>
                        {{ Form::text('company', null, ['class' => 'form-control !rounded-xl !border-[#ede8f5] focus:!border-[#a100ff] focus:!ring-[#a100ff] !text-[#1b1c1c] !bg-white px-4 py-3 shadow-sm transition-all','required', 'id' => 'editCompany','placeholder'=>__('messages.candidate_profile.company')]) }}
                    </div>
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('institution_type', 'Institution type:', ['class' => 'form-label text-[#4e4256] font-bold text-[14px] mb-2']) }}
                        {{ Form::select('institution_type', [
                            'Government school' => 'Government school',
                            'Private school' => 'Private school',
                            'International school' => 'International school',
                            'College / University' => 'College / University',
                            'Coaching centre' => 'Coaching centre',
                            'Online tutoring' => 'Online tutoring',
                            'None (fresher)' => 'None (fresher)',
                        ], null, ['class' => 'form-select !rounded-xl !border-[#ede8f5] focus:!border-[#a100ff] focus:!ring-[#a100ff] !text-[#1b1c1c] !bg-white px-4 py-3 shadow-sm transition-all', 'id' => 'editInstitutionType', 'placeholder' => 'Select']) }}
                    </div>
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('country', __('messages.company.country').(':'),['class' => 'form-label text-[#4e4256] font-bold text-[14px] mb-2']) }}
                        <span class="required text-red-500">*</span>
                        {{ Form::select('country_id',$data['countries'], null, ['id'=>'editCountry','class' => 'form-select countryId !rounded-xl !border-[#ede8f5] focus:!border-[#a100ff] focus:!ring-[#a100ff] !text-[#1b1c1c] !bg-white px-4 py-3 shadow-sm transition-all','placeholder' => __('messages.company.select_country'),'data-modal-type' => 'experience','data-is-edit' => 'true']) }}
                    </div>
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('state', __('messages.company.state').(':'),['class' => 'form-label text-[#4e4256] font-bold text-[14px] mb-2']) }}
                        {{ Form::select('state_id', [], null, ['id'=>'editState','class' => 'form-select stateId !rounded-xl !border-[#ede8f5] focus:!border-[#a100ff] focus:!ring-[#a100ff] !text-[#1b1c1c] !bg-white px-4 py-3 shadow-sm transition-all','placeholder' => __('messages.company.select_state'), 'data-modal-type' => 'experience','data-is-edit' => 'true']) }}
                    </div>
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('city', __('messages.company.city').(':'),['class' => 'form-label text-[#4e4256] font-bold text-[14px] mb-2']) }}
                        {{ Form::select('city_id', [],null, ['class' => 'form-select cityId !rounded-xl !border-[#ede8f5] focus:!border-[#a100ff] focus:!ring-[#a100ff] !text-[#1b1c1c] !bg-white px-4 py-3 shadow-sm transition-all','data-modal-type' => 'experience','id'=>'editCity','placeholder' => __('messages.company.select_city'),'data-is-edit' => 'true']) }}
                    </div>
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('start_date', __('messages.candidate_profile.start_date').(':'),['class' => 'form-label text-[#4e4256] font-bold text-[14px] mb-2']) }}
                        <span class="required text-red-500">*</span>
                        <input type="text" name="start_date" id="editStartDate" class="form-control !rounded-xl !border-[#ede8f5] focus:!border-[#a100ff] focus:!ring-[#a100ff] !text-[#1b1c1c] !bg-white px-4 py-3 shadow-sm transition-all" autocomplete="off" placeholder="{{__('messages.candidate_profile.start_date')}}">
                    </div>
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('end_date', __('messages.candidate_profile.end_date').(':'),['class' => 'form-label text-[#4e4256] font-bold text-[14px] mb-2']) }}
                        <span class="required text-red-500">*</span>
                        <input type="text" name="end_date" id="editEndDate" class="form-control !rounded-xl !border-[#ede8f5] focus:!border-[#a100ff] focus:!ring-[#a100ff] !text-[#1b1c1c] !bg-white px-4 py-3 shadow-sm transition-all" autocomplete="off" placeholder="{{__('messages.candidate_profile.end_date')}}">
                    </div>
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('currently_working', __('messages.candidate_profile.currently_working').(':'),['class' => 'form-label text-[#4e4256] font-bold text-[14px] mb-2']) }}
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input focus:!ring-[#a100ff] focus:!border-[#a100ff] checked:!bg-[#a100ff] checked:!border-[#a100ff] {{ checkLanguageSession() == 'ar' ? 'float-end' : '' }}" name="currently_working" type="checkbox" value="1" id="editWorking">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        {{ Form::label('description', __('messages.candidate_profile.description').':', ['class' => 'form-label text-[#4e4256] font-bold text-[14px] mb-2']) }}
                        {{ Form::textarea('description',null, ['class' => 'form-control !rounded-xl !border-[#ede8f5] focus:!border-[#a100ff] focus:!ring-[#a100ff] !text-[#1b1c1c] !bg-white px-4 py-3 shadow-sm transition-all','rows'=>'4','id' => 'editDescription','placeholder'=>__('messages.candidate_profile.description')]) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-[#fbf9f9] border-t border-[#ede8f5] px-8 py-5 flex justify-end gap-3">
                <button type="button" class="inline-flex items-center justify-center px-6 py-2.5 border border-[#ede8f5] text-[15px] font-bold rounded-xl text-[#4e4256] bg-white hover:bg-[#faf7ff] transition-all duration-300 m-0"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}
                </button>
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-[15px] font-bold rounded-xl text-white bg-[#a100ff] hover:bg-[#8e00e2] shadow-[0_4px_12px_rgba(161,0,255,0.2)] transition-all duration-300 m-0','id' => 'btnExperienceSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> ".__('messages.common.process')]) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
