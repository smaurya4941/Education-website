<div id="editEducationModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{  __('messages.candidate_profile.edit_education') }}</h2>
                <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editCareerEducationForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger hide d-none" id="editValidationErrorsBox">
                    <i class='fa-solid fa-face-frown me-4'></i>
                </div>
                {{ Form::hidden('educationId',null,['id'=>'educationId']) }}
                <div class="row">
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('degree_level_id', 'Degree:', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('degree_level_id', $data['degreeLevels'], null ,['class' => 'form-select','required','id' => 'editDegreeLevel']) }}
                    </div>

                    <div class="col-sm-6 mb-5">
                        {{ Form::label('degree_title', 'Specialisation:', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('degree_title', null, ['class' => 'form-control','required','id'=>'editDegreeTitle','placeholder'=>'Mathematics, English Literature']) }}
                    </div>
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('institute', 'University / institution:', ['class' => 'form-label']) }}
                        {{ Form::text('institute', null,['class' => 'form-control','id'=>'editInstitute','placeholder'=>'Delhi University']) }}
                    </div>
                    <div class="col-sm-6 mb-5">
                        {{ Form::label('year', 'Year of completion:', ['class' => 'form-label']) }}
                        {{ Form::selectRange('year', date('Y') + 1, 1970, null, ['class' => 'form-select','placeholder' => 'Select year','id' => 'editYear'])}}
                        {{ Form::hidden('result', 'Completed', ['id' => 'editResult']) }}
                    </div>

                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-0','id' => 'editEducationSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> ".__('messages.common.process')]) }}
                <button type="button" class="btn btn-secondary my-0 {{ checkLanguageSession() == 'ar' ? 'me-5' : 'ms-5' }} me-0"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}
                </button>
            </div>
            {{--            <div class="text-right">--}}
            {{--                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary me-3','id' => 'btnEditEducationSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}--}}
            {{--                <button type="button" class="btn btn-light btn-active-light-primary me-2"--}}
            {{--                        id="btnEditEducationSave"--}}
            {{--                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>--}}
            {{--            </div>--}}
            {{ Form::close() }}
        </div>
    </div>
</div>
