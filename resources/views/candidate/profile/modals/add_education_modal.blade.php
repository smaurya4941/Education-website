<div id="addEducationModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content border-0 rounded-[24px] shadow-[0_12px_40px_rgba(161,0,255,0.15)] bg-white overflow-hidden">
            <div class="modal-header border-b border-[#ede8f5] bg-[#faf7ff] px-8 py-5">
                <h3 class="modal-title text-[22px] font-bold text-[#1b1c1c] font-['Plus_Jakarta_Sans'] m-0 flex items-center gap-3">
                    <span class="w-10 h-10 rounded-full bg-white text-[#a100ff] flex items-center justify-center border border-[#e1b6ff] shadow-sm">
                        <i class="fas fa-graduation-cap"></i>
                    </span>
                    {{ __('messages.candidate_profile.add_education')  }}
                </h3>
                <button type="button" class="btn-close m-0 opacity-50 hover:opacity-100 transition-opacity" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addNewEducationForm', 'class' => 'm-0']) }}
            <div class="modal-body px-8 py-6 bg-white">
                <div class="alert alert-danger hide d-none rounded-xl" id="validationErrorsBox">
                    <i class='fa-solid fa-face-frown me-4'></i>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('degree_level_id', 'Degree:', ['class' => 'form-label text-[#4e4256] font-bold text-[14px] mb-2']) }}
                        <span class="required text-red-500">*</span>
                        {{ Form::select('degree_level_id', $data['degreeLevels'], null ,['class' => 'form-select !rounded-xl !border-[#ede8f5] focus:!border-[#a100ff] focus:!ring-[#a100ff] !text-[#1b1c1c] !bg-white px-4 py-3 shadow-sm transition-all','required','id' => 'degreeLevelId','placeholder'=>'Select degree']) }}
                    </div>
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('degree_title', 'Specialisation:', ['class' => 'form-label text-[#4e4256] font-bold text-[14px] mb-2']) }}
                        <span class="required text-red-500">*</span>
                        {{ Form::text('degree_title', null, ['class' => 'form-control !rounded-xl !border-[#ede8f5] focus:!border-[#a100ff] focus:!ring-[#a100ff] !text-[#1b1c1c] !bg-white px-4 py-3 shadow-sm transition-all','required', 'placeholder'=>'Mathematics, English Literature']) }}
                    </div>
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('institute', 'University / institution:', ['class' => 'form-label text-[#4e4256] font-bold text-[14px] mb-2']) }}
                        {{ Form::text('institute', null,['class' => 'form-control !rounded-xl !border-[#ede8f5] focus:!border-[#a100ff] focus:!ring-[#a100ff] !text-[#1b1c1c] !bg-white px-4 py-3 shadow-sm transition-all','placeholder'=>'Delhi University']) }}
                    </div>
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('year', 'Year of completion:', ['class' => 'form-label text-[#4e4256] font-bold text-[14px] mb-2']) }}
                        {{ Form::selectRange('year', date('Y') + 1, 1970, null, ['id'=>'educationYearId','class' => 'form-select !rounded-xl !border-[#ede8f5] focus:!border-[#a100ff] focus:!ring-[#a100ff] !text-[#1b1c1c] !bg-white px-4 py-3 shadow-sm transition-all','data-modal-type' => 'education','placeholder' => 'Select year'])}}
                        {{ Form::hidden('result', 'Completed') }}
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-[#fbf9f9] border-t border-[#ede8f5] px-8 py-5 flex justify-end gap-3">
                <button type="button" class="inline-flex items-center justify-center px-6 py-2.5 border border-[#ede8f5] text-[15px] font-bold rounded-xl text-[#4e4256] bg-white hover:bg-[#faf7ff] transition-all duration-300 m-0"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}
                </button>
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-[15px] font-bold rounded-xl text-white bg-[#a100ff] hover:bg-[#8e00e2] shadow-[0_4px_12px_rgba(161,0,255,0.2)] transition-all duration-300 m-0','id' => 'btnEducationSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> ".__('messages.common.process')]) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
