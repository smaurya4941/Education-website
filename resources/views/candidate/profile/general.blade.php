@extends('candidate.profile.index')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/inttel/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css') }}">
    <style>
        .teacher-profile-wrap{max-width:850px;margin:0 auto}
        .teacher-progress{display:flex;align-items:flex-start;justify-content:space-between;width:100%;margin-bottom:1.5rem}
        .teacher-step-node{display:flex;flex-direction:column;align-items:center;gap:6px;min-width:92px}
        .teacher-step-circle{width:34px;height:34px;border-radius:50%;border:1px solid #ede8f5;background:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;color:#807287;transition:all 0.3s;}
        .teacher-step-circle.active{background:#a100ff;border-color:#a100ff;color:#fff;box-shadow:0 4px 12px rgba(161,0,255,0.2)}
        .teacher-step-circle.done{background:#10b981;border-color:#10b981;color:#fff}
        .teacher-step-label{font-size:12px;color:#807287;text-align:center;font-family:'Plus Jakarta Sans',sans-serif;white-space:nowrap;}
        .teacher-step-label.active{color:#a100ff;font-weight:700}
        .teacher-step-label.done{color:#10b981;font-weight:700}
        .teacher-step-line{height:2px;background:#ede8f5;flex:1;margin-top:16px;transition:all 0.3s;}
        .teacher-step-line.done{background:#10b981}
        .teacher-form-section{display:none}
        .teacher-form-section.visible{display:block;animation:fadeIn 0.3s ease-in;}
        .teacher-section-title{font-size:1.25rem;font-weight:800;color:#1b1c1c;margin-bottom:.25rem;font-family:'Plus Jakarta Sans',sans-serif;}
        .teacher-section-sub{color:#807287;margin-bottom:1.25rem;font-size:0.9rem;font-family:'Plus Jakarta Sans',sans-serif;}
        .teacher-check-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:.5rem}
        .teacher-chip-grid{display:grid;grid-template-columns:repeat(7,minmax(0,1fr));gap:.5rem}
        .teacher-chip input{display:none}
        .teacher-chip span{display:block;text-align:center;border:1px solid #ede8f5;border-radius:.5rem;padding:.5rem .25rem;cursor:pointer;color:#4e4256;transition:all 0.2s;background:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-size:0.85rem;}
        .teacher-chip input:checked+span{background:#faf7ff;border-color:#e1b6ff;color:#a100ff;font-weight:700;box-shadow:0 2px 8px rgba(161,0,255,0.08)}
        .teacher-tags{display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:.5rem}
        .teacher-tag{background:#faf7ff;border:1px solid #e1b6ff;border-radius:20px;padding:.25rem .75rem;color:#a100ff;display:inline-flex;gap:.5rem;align-items:center;font-weight:600;font-size:0.85rem;font-family:'Plus Jakarta Sans',sans-serif;}
        .teacher-tag button{border:0;background:transparent;color:#a100ff;line-height:1;font-size:1rem;}
        
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
        @media (max-width: 575.98px){
            .teacher-progress{overflow-x:auto;padding-bottom:.5rem}
            .teacher-check-grid{grid-template-columns:1fr}
            .teacher-chip-grid{grid-template-columns:repeat(4,minmax(0,1fr))}
        }
        .mobile-itel-width .iti { width: 100% !important; display: block !important; }
        .mobile-itel-width .iti input { padding-left: 95px !important; width: 100% !important; }
        
        /* Force checkboxes to appear natively if theme hides them */
        .teacher-form-section .form-check-input {
            border: 1px solid #a49da8 !important;
            appearance: auto !important;
            -webkit-appearance: auto !important;
            width: 1.25rem !important;
            height: 1.25rem !important;
            margin-top: .15rem !important;
        }
    </style>
@endpush
@section('section')
    @php
        $candidate = $user->candidate;
        $education = $data['candidateEducations']->first();
        $experience = $data['candidateExperiences']->first();
        $certifications = old('teaching_certifications', $candidate->teaching_certifications ?? []);
        $otherCertifications = old('other_certification', $candidate->other_certification ?? []);
        $subjects = old('teaching_subjects', $candidate->teaching_subjects ?? []);
        $gradeLevels = old('grade_levels', $candidate->grade_levels ?? []);
        $mediums = old('instruction_mediums', $candidate->instruction_mediums ?? []);
        $modes = old('teaching_modes', $candidate->teaching_modes ?? []);
        $availableDays = old('available_days', $candidate->available_days ?? []);
        $spokenLanguages = old('spoken_languages', $candidate->spoken_languages ?? []);
        $genderValue = old('gender', $user->gender);
        $genderText = $genderValue === 0 || $genderValue === '0' ? '0' : ($genderValue === 1 || $genderValue === '1' ? '1' : $genderValue);
        $dobValue = old('dob', ! empty($user->dob) ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : null);
    @endphp
    <div class="teacher-profile-wrap">
        <div class="bg-white border border-[#ede8f5] rounded-[24px] shadow-[0_4px_20px_rgba(161,0,255,0.06)] mb-6">
            <div class="p-5 lg:p-8">
                {{ Form::model($user, ['route' => 'candidate-profile.update', 'files' => true, 'id' => 'candidateProfileUpdate', 'method' => 'put', 'novalidate' => true]) }}
                {{ Form::hidden('isEdit', true, ['id' => 'isEdit']) }}
                {{ Form::hidden('immediate_available', 1) }}
                {{ Form::hidden('current_salary', $candidate->current_salary) }}

                <div class="alert alert-danger d-none" id="validationErrors">
                    <i class='fa-solid fa-face-frown me-4'></i>
                </div>

                <div class="teacher-progress" id="teacherProfileProgress"></div>

                <div id="teacherStep1" class="teacher-form-section visible">
                    <p class="teacher-section-title">Personal information</p>
                    <p class="teacher-section-sub">Let schools know who you are.</p>

                    <div class="row">
                        <div class="col-md-6 mb-4 mobile-itel-width">
                            {{ Form::label('phone', 'Phone number:', ['class' => 'form-label']) }}<span class="required"></span>
                            {{ Form::tel('phone', old('phone', $user->phone), ['class' => 'form-control', 'required', 'id' => 'phoneNumber', 'placeholder' => '+91 98765 43210']) }}
                            {{ Form::hidden('region_code', old('region_code', $user->region_code), ['id' => 'prefix_code']) }}
                        </div>
                        <div class="col-md-6 mb-4">
                            {{ Form::label('dob', 'Date of birth:', ['class' => 'form-label']) }}
                            <input type="date" name="dob" class="form-control" value="{{ $dobValue }}">
                        </div>
                        <div class="col-md-6 mb-4">
                            {{ Form::label('gender', 'Gender:', ['class' => 'form-label']) }}
                            {{ Form::select('gender', ['1' => 'Female', '0' => 'Male', '2' => 'Non-binary', '3' => 'Prefer not to say'], $genderText, ['class' => 'form-select', 'placeholder' => 'Select']) }}
                        </div>
                        <div class="col-md-4 mb-4">
                            {{ Form::label('country_id', 'Country:', ['class' => 'form-label']) }}
                            {{ Form::select('country_id', $data['countries'], old('country_id', $user->country_id), ['class' => 'form-select', 'id' => 'countryId', 'placeholder' => 'Select country']) }}
                        </div>
                        <div class="col-md-4 mb-4">
                            {{ Form::label('state_id', 'State:', ['class' => 'form-label']) }}
                            {{ Form::select('state_id', isset($states) && $states != null ? $states : [], old('state_id', $user->state_id), ['id' => 'stateId', 'class' => 'form-select', 'placeholder' => 'Select state']) }}
                        </div>
                        <div class="col-md-4 mb-4">
                            {{ Form::label('city_id', 'City:', ['class' => 'form-label']) }}
                            {{ Form::select('city_id', isset($cities) && $cities != null ? $cities : [], old('city_id', $user->city_id), ['class' => 'form-select', 'id' => 'cityId', 'placeholder' => 'Select city']) }}
                        </div>
                    </div>
                </div>

                <div id="teacherStep2" class="teacher-form-section">
                    <p class="teacher-section-title">Qualifications & experience</p>
                    <p class="teacher-section-sub">Your academic background and teaching history.</p>

                    <div class="row">

                        <div class="col-12 mb-4">
                            <label class="form-label">Teaching certifications</label>
                            <div class="teacher-check-grid">
                                @foreach (['B.Ed (Bachelor of Education)', 'CTET (Central Teacher Eligibility Test)', 'STET (State Teacher Eligibility Test)', 'TET (Teacher Eligibility Test)', 'Other certification'] as $certification)
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input teaching-cert-checkbox" type="checkbox" name="teaching_certifications[]" value="{{ $certification }}" @checked(in_array($certification, $certifications)) data-is-other="{{ $certification === 'Other certification' ? 'true' : 'false' }}">
                                        <label class="form-check-label">{{ $certification }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-3" id="otherCertificationInputWrapper" style="display: {{ in_array('Other certification', $certifications) ? 'block' : 'none' }};">
                                <label class="form-label">Other certifications <span class="required"></span></label>
                                <div class="teacher-tags" data-tag-list="otherCertifications"></div>
                                <div class="input-group">
                                    <input type="text" class="form-control" data-tag-input="otherCertifications" placeholder="e.g. TEFL, TESOL" id="otherCertificationInput">
                                    <button class="btn btn-light" type="button" data-tag-add="otherCertifications"><i class="fa-solid fa-plus"></i> Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            {{ Form::label('experience', 'Total years of experience:', ['class' => 'form-label']) }}<span class="required"></span>
                            {{ Form::select('experience', [0 => 'Fresher (0 years)', 2 => '1-2 years', 5 => '3-5 years', 10 => '6-10 years', 11 => '10+ years'], old('experience', $candidate->experience), ['class' => 'form-select', 'required', 'placeholder' => 'Select']) }}
                        </div>
                        <div class="col-md-6 mb-4">
                            {{ Form::label('institution_type', 'Current / last institution type:', ['class' => 'form-label']) }}
                            {{ Form::select('institution_type', ['Government school' => 'Government school', 'Private school' => 'Private school', 'International school' => 'International school', 'College / University' => 'College / University', 'Coaching centre' => 'Coaching centre', 'Online tutoring' => 'Online tutoring', 'None (fresher)' => 'None (fresher)'], old('institution_type', $experience->institution_type ?? null), ['class' => 'form-select', 'placeholder' => 'Select']) }}
                        </div>
                        <div class="col-12 mb-4">
                            {{ Form::label('company', 'Previous institution name:', ['class' => 'form-label']) }}
                            {{ Form::text('company', old('company', $experience->company ?? null), ['class' => 'form-control', 'placeholder' => "St. Mary's High School, New Delhi"]) }}
                            {{ Form::hidden('experience_title', old('experience_title', $experience->experience_title ?? 'Teacher')) }}
                        </div>
                    </div>
                </div>

                <div id="teacherStep3" class="teacher-form-section">
                    <p class="teacher-section-title">Subjects & teaching level</p>
                    <p class="teacher-section-sub">Tell schools what and whom you can teach.</p>

                    <div class="mb-4">
                        <label class="form-label">Subjects you teach <span class="required"></span></label>
                        <div class="teacher-tags" data-tag-list="subjects"></div>
                        <div class="input-group">
                            <input type="text" class="form-control" data-tag-input="subjects" placeholder="e.g. Mathematics, Physics, English">
                            <button class="btn btn-light" type="button" data-tag-add="subjects"><i class="fa-solid fa-plus"></i> Add</button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Grade levels you can teach <span class="required"></span></label>
                        <div class="teacher-check-grid">
                            @foreach (['Pre-primary (Nursery-KG)', 'Primary (Class 1-5)', 'Middle school (Class 6-8)', 'Secondary (Class 9-10)', 'Senior secondary (Class 11-12)', 'Undergraduate / College'] as $level)
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="grade_levels[]" value="{{ $level }}" @checked(in_array($level, $gradeLevels))>
                                    <label class="form-check-label">{{ $level }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Medium of instruction</label>
                        <div class="teacher-check-grid">
                            @foreach (['English', 'Hindi', 'Bilingual', 'Regional language'] as $medium)
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="instruction_mediums[]" value="{{ $medium }}" @checked(in_array($medium, $mediums))>
                                    <label class="form-check-label">{{ $medium }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Teaching mode preference</label>
                        <div class="teacher-check-grid">
                            @foreach (['Offline (in-school)', 'Online', 'Hybrid', 'Home tutoring'] as $mode)
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="teaching_modes[]" value="{{ $mode }}" @checked(in_array($mode, $modes))>
                                    <label class="form-check-label">{{ $mode }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div id="teacherStep4" class="teacher-form-section">
                    <p class="teacher-section-title">Availability & preferences</p>
                    <p class="teacher-section-sub">Help schools match you to the right opening.</p>

                    <div class="mb-4">
                        <label class="form-label">Available days</label>
                        <div class="teacher-chip-grid">
                            @foreach (['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                                <label class="teacher-chip">
                                    <input type="checkbox" name="available_days[]" value="{{ $day }}" @checked(in_array($day, $availableDays))>
                                    <span>{{ $day }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-5">
                            {{ Form::label('preferred_shift', 'Preferred shift:', ['class' => 'form-label']) }}
                            {{ Form::select('preferred_shift', ['Morning (7 AM - 12 PM)' => 'Morning (7 AM - 12 PM)', 'Afternoon (12 PM - 4 PM)' => 'Afternoon (12 PM - 4 PM)', 'Evening (4 PM - 8 PM)' => 'Evening (4 PM - 8 PM)', 'Flexible' => 'Flexible'], old('preferred_shift', $candidate->preferred_shift), ['class' => 'form-select', 'placeholder' => 'Select']) }}
                        </div>
                        <div class="col-md-6 mb-5">
                            {{ Form::label('employment_type', 'Employment type:', ['class' => 'form-label']) }}<span class="required"></span>
                            {{ Form::select('employment_type', ['Full-time' => 'Full-time', 'Part-time' => 'Part-time', 'Contractual' => 'Contractual', 'Guest / Visiting faculty' => 'Guest / Visiting faculty', 'Private tutor' => 'Private tutor'], old('employment_type', $candidate->employment_type), ['class' => 'form-select', 'required', 'placeholder' => 'Select']) }}
                        </div>
                        <div class="col-md-6 mb-5">
                            {{ Form::label('expected_salary', 'Expected salary (per month):', ['class' => 'form-label']) }}
                            {{ Form::number('expected_salary', old('expected_salary', $candidate->expected_salary), ['class' => 'form-control', 'placeholder' => '20000']) }}
                        </div>
                        <div class="col-md-6 mb-5">
                            {{ Form::label('relocation_preference', 'Open to relocation?', ['class' => 'form-label']) }}
                            {{ Form::select('relocation_preference', ['Yes, anywhere' => 'Yes, anywhere', 'Yes, same state only' => 'Yes, same state only', 'No, current city only' => 'No, current city only'], old('relocation_preference', $candidate->relocation_preference), ['class' => 'form-select', 'placeholder' => 'Select']) }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Languages you speak</label>
                        <div class="teacher-tags" data-tag-list="languages"></div>
                        <div class="input-group">
                            <input type="text" class="form-control" data-tag-input="languages" placeholder="e.g. Hindi, English, Telugu">
                            <button class="btn btn-light" type="button" data-tag-add="languages"><i class="fa-solid fa-plus"></i> Add</button>
                        </div>
                    </div>

                    <div class="mb-4">
                        {{ Form::label('teaching_bio', 'Teaching philosophy / bio:', ['class' => 'form-label']) }}
                        {{ Form::textarea('teaching_bio', old('teaching_bio', $candidate->teaching_bio), ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Briefly describe your teaching approach, strengths, and motivation as an educator']) }}
                    </div>

                    <div class="mb-4">
                        {{ Form::label('resume_file', 'Upload resume / CV:', ['class' => 'form-label']) }}
                        {{ Form::file('resume_file', ['class' => 'form-control', 'accept' => '.pdf,.doc,.docx']) }}
                    </div>

                    {{-- Terms and conditions hidden for now --}}
                </div>

                <div class="d-flex justify-content-between mt-8">
                    <button type="button" class="btn btn-light" id="teacherProfileBack">Back</button>
                    <div class="d-flex gap-3 align-items-center ms-auto">
                        <button type="button" class="btn btn-primary" id="teacherProfileNext">Next <i class="fa-solid fa-arrow-right ms-2"></i></button>
                        {{ Form::submit('Submit profile', ['class' => 'btn btn-success', 'id' => 'teacherProfileSubmit', 'style' => 'display: none;']) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var phoneNo = "{{ old('region_code') . old('phone') }}";
        window.teacherProfileInitialTags = {
            subjects: @json(is_array($subjects) ? array_values($subjects) : []),
            languages: @json(is_array($spokenLanguages) ? array_values($spokenLanguages) : []),
            otherCertifications: @json(is_array($otherCertifications) ? array_values($otherCertifications) : []),
        };
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const totalSteps = 4;
            const labels = ['Personal info', 'Qualifications', 'Subjects', 'Availability'];
            let currentStep = 1;
            const progress = document.getElementById('teacherProfileProgress');
            const form = document.getElementById('candidateProfileUpdate');
            const backBtn = document.getElementById('teacherProfileBack');
            const nextBtn = document.getElementById('teacherProfileNext');
            const submitBtn = document.getElementById('teacherProfileSubmit');
            const tags = window.teacherProfileInitialTags || {subjects: [], languages: [], otherCertifications: []};

            function renderProgress() {
                progress.innerHTML = '';
                labels.forEach(function (label, index) {
                    const step = index + 1;
                    const state = step < currentStep ? 'done' : step === currentStep ? 'active' : '';
                    const node = document.createElement('div');
                    node.className = 'teacher-step-node';
                    node.style.cursor = 'pointer';
                    node.innerHTML = '<div class="teacher-step-circle ' + state + '">' + (step < currentStep ? '<i class="fa-solid fa-check"></i>' : step) + '</div><span class="teacher-step-label ' + state + '">' + label + '</span>';
                    
                    node.addEventListener('click', function() {
                        currentStep = step;
                        showStep(currentStep);
                    });

                    progress.appendChild(node);
                    if (step < totalSteps) {
                        const line = document.createElement('div');
                        line.className = 'teacher-step-line' + (step < currentStep ? ' done' : '');
                        progress.appendChild(line);
                    }
                });
            }

            function showStep(step, scrollToTop = true) {
                document.querySelectorAll('.teacher-form-section').forEach(function (section) {
                    section.classList.remove('visible');
                });
                document.getElementById('teacherStep' + step).classList.add('visible');
                if (step === 1) {
                    backBtn.style.setProperty('display', 'none', 'important');
                } else {
                    backBtn.style.setProperty('display', 'inline-block', 'important');
                }
                
                if (step === totalSteps) {
                    nextBtn.style.setProperty('display', 'none', 'important');
                    submitBtn.style.setProperty('display', 'inline-block', 'important');
                } else {
                    nextBtn.style.setProperty('display', 'inline-block', 'important');
                    submitBtn.style.setProperty('display', 'none', 'important');
                }
                
                renderProgress();
                if (scrollToTop) {
                    window.scrollTo({top: 0, behavior: 'smooth'});
                }
            }

            function validateStep(step) {
                const section = document.getElementById('teacherStep' + step);
                const controls = section.querySelectorAll('input, select, textarea');

                for (const control of controls) {

                    if (!control.checkValidity()) {
                        control.reportValidity();
                        return false;
                    }
                }

                if (step === 2) {
                    const otherCheckbox = section.querySelector('.teaching-cert-checkbox[data-is-other="true"]');
                    if (otherCheckbox && otherCheckbox.checked && tags.otherCertifications.length === 0) {
                        const otherInput = document.querySelector('[data-tag-input="otherCertifications"]');
                        otherInput.setCustomValidity('Please add at least one other certification.');
                        otherInput.reportValidity();
                        otherInput.addEventListener('input', function clearOtherValidation() {
                            otherInput.setCustomValidity('');
                            otherInput.removeEventListener('input', clearOtherValidation);
                        });
                        return false;
                    }
                }

                if (step === 3 && tags.subjects.length === 0) {
                    const subjectInput = document.querySelector('[data-tag-input="subjects"]');
                    subjectInput.setCustomValidity('Please add at least one subject.');
                    subjectInput.reportValidity();
                    subjectInput.addEventListener('input', function clearSubjectValidation() {
                        subjectInput.setCustomValidity('');
                        subjectInput.removeEventListener('input', clearSubjectValidation);
                    });
                    return false;
                }

                if (step === 3 && section.querySelectorAll('input[name="grade_levels[]"]:checked').length === 0) {
                    const firstGradeLevel = section.querySelector('input[name="grade_levels[]"]');
                    firstGradeLevel.setCustomValidity('Please select at least one grade level.');
                    firstGradeLevel.reportValidity();
                    firstGradeLevel.addEventListener('change', function clearGradeValidation() {
                        firstGradeLevel.setCustomValidity('');
                        firstGradeLevel.removeEventListener('change', clearGradeValidation);
                    });
                    return false;
                }


                return true;
            }

            function validateAllSteps() {
                for (let step = 1; step <= totalSteps; step++) {
                    currentStep = step;
                    showStep(currentStep, false);
                    if (!validateStep(step)) {
                        return false;
                    }
                }

                return true;
            }

            function renderTags(key) {
                const list = document.querySelector('[data-tag-list="' + key + '"]');
                list.innerHTML = '';
                tags[key].forEach(function (value) {
                    const item = document.createElement('span');
                    item.className = 'teacher-tag';
                    
                    let hiddenInputName = '';
                    if (key === 'subjects') hiddenInputName = 'teaching_subjects[]';
                    else if (key === 'languages') hiddenInputName = 'spoken_languages[]';
                    else if (key === 'otherCertifications') hiddenInputName = 'other_certification[]';

                    item.innerHTML = '<span></span><button type="button" aria-label="Remove">&times;</button><input type="hidden" name="' + hiddenInputName + '">';
                    item.querySelector('span').textContent = value;
                    item.querySelector('input').value = value;
                    item.querySelector('button').addEventListener('click', function () {
                        tags[key] = tags[key].filter(function (tag) { return tag !== value; });
                        renderTags(key);
                    });
                    list.appendChild(item);
                });
            }

            function addTag(key) {
                const input = document.querySelector('[data-tag-input="' + key + '"]');
                const value = input.value.trim();
                if (!value || tags[key].includes(value)) {
                    return;
                }
                tags[key].push(value);
                input.value = '';
                renderTags(key);
            }

            document.querySelectorAll('[data-tag-add]').forEach(function (button) {
                button.addEventListener('click', function () { addTag(button.dataset.tagAdd); });
            });
            document.querySelectorAll('[data-tag-input]').forEach(function (input) {
                input.addEventListener('keydown', function (event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        addTag(input.dataset.tagInput);
                    }
                });
            });



            backBtn.addEventListener('click', function () {
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            });
            nextBtn.addEventListener('click', function () {
                if (currentStep < totalSteps && validateStep(currentStep)) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                if (validateAllSteps()) {
                    HTMLFormElement.prototype.submit.call(form);
                }
            });

            renderTags('subjects');
            renderTags('languages');
            renderTags('otherCertifications');
            showStep(currentStep);

            const otherCertWrapper = document.getElementById('otherCertificationInputWrapper');
            const otherCertInput = document.getElementById('otherCertificationInput');
            
            document.querySelectorAll('.teaching-cert-checkbox').forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    if (this.dataset.isOther === 'true') {
                        if (this.checked) {
                            otherCertWrapper.style.display = 'block';
                        } else {
                            otherCertWrapper.style.display = 'none';
                            tags.otherCertifications = [];
                            renderTags('otherCertifications');
                            otherCertInput.value = '';
                        }
                    }
                });
            });
        });
    </script>
@endpush
