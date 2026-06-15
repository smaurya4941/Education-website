{{ Form::open(['id'=>'editCVEducationForm']) }}
<div class="alert alert-danger d-none" id="editValidationErrorsBox">
    <i class='fa-solid fa-face-frown me-4'></i>
</div>
<input type="hidden" id="educationId">
<div class="row">
    <div class="col-sm-6 mb-5">
        {{ Form::label('degree_level_id', 'Degree:', ['class' => 'form-label ']) }}
        <span class="required"></span>
        {{ Form::select('degree_level_id', $data['degreeLevels'], null, ['class' => 'form-select','required','id' => 'editDegreeLevel','placeholder'=> 'Select degree']) }}
    </div>
    <div class="col-sm-6 mb-5">
        {{ Form::label('degree_title', 'Specialisation:', ['class' => 'form-label ']) }}
        <span class="required"></span>
        {{ Form::text('degree_title', null, ['class' => 'form-control','required','id' => 'editDegreeTitle']) }}
    </div>
    <div class="col-sm-6 mb-5">
        {{ Form::label('institute', 'University / institution:', ['class' => 'form-label ']) }}
        {{ Form::text('institute', null, ['class' => 'form-control', 'id' => 'editInstitute']) }}
    </div>
    <div class="col-sm-6 mb-5">
        {{ Form::label('year', 'Year of completion:', ['class' => 'form-label ']) }}
        {{ Form::selectYear('year', date('Y') + 1, 1970, null, ['class' => 'form-select', 'id' => 'editYear']) }}
        {{ Form::hidden('result', 'Completed', ['id' => 'editResult']) }}
    </div>
</div>
<div class="d-flex justify-content-end">
    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnEditEducationSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
    <button type="button" id="btnEditEducationCancel"
            class="btn btn-secondary me-2">{{ __('messages.common.cancel') }}</button>
</div>
{{ Form::close() }}
