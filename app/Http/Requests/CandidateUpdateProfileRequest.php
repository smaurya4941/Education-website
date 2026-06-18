<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CandidateUpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $currentSalary = removeCommaFromNumbers($this->request->get('current_salary'));
        $expectedSalary = removeCommaFromNumbers($this->request->get('expected_salary'));

        $this->request->set('current_salary', $currentSalary);
        $this->request->set('expected_salary', $expectedSalary);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = Auth::user()->id;

        return [
            'first_name' => 'nullable|max:150',
            'last_name' => 'nullable|max:150',
            'email' => 'nullable|email:filter|unique:users,email,'.$id,
            'dob' => 'nullable|date',
            'phone' => 'required',
            'gender' => 'nullable',
            'country_id' => 'nullable',
            'state_id' => 'nullable',
            'city_id' => 'nullable',
            'address' => 'nullable|max:500',
            'experience' => 'required|numeric|min:0|max:60',
            'expected_salary' => 'nullable|numeric|min:0|max:999999999',
            'password' => 'nullable|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'nullable|min:6',
            'degree_level_id' => 'nullable',
            'degree_title' => 'nullable|max:150',
            'institute' => 'nullable|max:150',
            'year' => 'nullable|integer|min:1970|max:'.(date('Y') + 1),
            'teaching_subjects' => 'required|array|min:1',
            'grade_levels' => 'required|array|min:1',
            'employment_type' => 'required|max:150',
            'resume_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'image' => 'nullable|mimes:jpeg,jpg,png',

        ];
    }
}
