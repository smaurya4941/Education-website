<?php
$data = json_decode(file_get_contents("options.json"), true); 
$html = "<form method=\"POST\" action=\"/employer/jobs/store\" id=\"createJobForm\">\n";
$html .= "    <!-- CSRF Token (Laravel) -->\n";
$html .= "    <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token() }}\">\n";
$html .= "    <div class=\"row\">\n";

function getOptions($arr) {
    $out = "";
    foreach($arr as $k => $v) {
        $out .= "                <option value=\"$k\">" . htmlspecialchars($v) . "</option>\n";
    }
    return $out;
}

// Title
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Job Title <span class=\"text-danger\">*</span></label>\n            <input type=\"text\" name=\"job_title\" class=\"form-control\" required placeholder=\"Job Title\">\n        </div>\n";

// Job Type
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Job Type <span class=\"text-danger\">*</span></label>\n            <select name=\"job_type_id\" class=\"form-select\" required>\n                <option value=\"\" disabled selected>Select Job Type</option>\n" . getOptions($data["jobType"]) . "            </select>\n        </div>\n";

// Job Category
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Job Category <span class=\"text-danger\">*</span></label>\n            <select name=\"job_category_id\" class=\"form-select\" required>\n                <option value=\"\" disabled selected>Select Job Category</option>\n" . getOptions($data["jobCategory"]) . "            </select>\n        </div>\n";

// Job Skill
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Job Skill <span class=\"text-danger\">*</span></label>\n            <select name=\"jobsSkill[]\" class=\"form-select\" multiple required>\n" . getOptions($data["jobSkill"]) . "            </select>\n        </div>\n";

// Description
$html .= "        <div class=\"col-12 mb-4\">\n            <label class=\"form-label\">Job Description <span class=\"text-danger\">*</span></label>\n            <div id=\"details\"></div>\n            <input type=\"hidden\" name=\"description\" id=\"job_desc\">\n        </div>\n";

// Key Responsibilities
$html .= "        <div class=\"col-12 mb-4\">\n            <label class=\"form-label\">Key Responsibilities <span class=\"text-danger\">*</span></label>\n            <div id=\"response\"></div>\n            <input type=\"hidden\" name=\"key_responsibilities\" id=\"key_responsibilities\">\n        </div>\n";

// Gender Preference
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Gender Preference</label>\n            <select name=\"no_preference\" class=\"form-select\">\n                <option value=\"\" disabled selected>Select Gender</option>\n                <option value=\"1\">Male</option>\n                <option value=\"2\">Female</option>\n                <option value=\"3\">No Preference</option>\n            </select>\n        </div>\n";

// Job Expiry Date
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Job Expiry Date <span class=\"text-danger\">*</span></label>\n            <input type=\"date\" name=\"job_expiry_date\" class=\"form-control\" required>\n        </div>\n";

// Salary From
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Salary From <span class=\"text-danger\">*</span></label>\n            <input type=\"number\" name=\"salary_from\" class=\"form-control\" required placeholder=\"Salary From\">\n        </div>\n";

// Salary To
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Salary To <span class=\"text-danger\">*</span></label>\n            <input type=\"number\" name=\"salary_to\" class=\"form-control\" required placeholder=\"Salary To\">\n        </div>\n";

// Currency
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Currency <span class=\"text-danger\">*</span></label>\n            <select name=\"currency_id\" class=\"form-select\" required>\n                <option value=\"\" disabled selected>Select Currency</option>\n" . getOptions($data["currencies"]) . "            </select>\n        </div>\n";

// Salary Period
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Salary Period <span class=\"text-danger\">*</span></label>\n            <select name=\"salary_period_id\" class=\"form-select\" required>\n                <option value=\"\" disabled selected>Select Salary Period</option>\n" . getOptions($data["salaryPeriods"]) . "            </select>\n        </div>\n";

// Country
$html .= "        <div class=\"col-md-4 mb-4\">\n            <label class=\"form-label\">Country <span class=\"text-danger\">*</span></label>\n            <select name=\"country_id\" class=\"form-select\" required></select>\n        </div>\n";

// State
$html .= "        <div class=\"col-md-4 mb-4\">\n            <label class=\"form-label\">State <span class=\"text-danger\">*</span></label>\n            <select name=\"state_id\" class=\"form-select\" required></select>\n        </div>\n";

// City
$html .= "        <div class=\"col-md-4 mb-4\">\n            <label class=\"form-label\">City <span class=\"text-danger\">*</span></label>\n            <select name=\"city_id\" class=\"form-select\" required></select>\n        </div>\n";

// Career Level
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Career Level</label>\n            <select name=\"career_level_id\" class=\"form-select\">\n                <option value=\"\" disabled selected>Select Career Level</option>\n" . getOptions($data["careerLevels"]) . "            </select>\n        </div>\n";

// Job Shift
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Job Shift</label>\n            <select name=\"job_shift_id\" class=\"form-select\">\n                <option value=\"\" disabled selected>Select Job Shift</option>\n" . getOptions($data["jobShift"]) . "            </select>\n        </div>\n";

// Job Tags
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Job Tags</label>\n            <select name=\"jobTag[]\" class=\"form-select\" multiple>\n" . getOptions($data["jobTag"]) . "            </select>\n        </div>\n";

// Degree Level
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Degree Level</label>\n            <select name=\"degree_level_id\" class=\"form-select\">\n                <option value=\"\" disabled selected>Select Degree Level</option>\n" . getOptions($data["requiredDegreeLevel"]) . "            </select>\n        </div>\n";

// Functional Area
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Functional Area <span class=\"text-danger\">*</span></label>\n            <select name=\"functional_area_id\" class=\"form-select\" required>\n                <option value=\"\" disabled selected>Select Functional Area</option>\n" . getOptions($data["functionalArea"]) . "            </select>\n        </div>\n";

// Position
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">No. of Positions <span class=\"text-danger\">*</span></label>\n            <input type=\"number\" name=\"position\" class=\"form-control\" required>\n        </div>\n";

// Experience
$html .= "        <div class=\"col-md-6 mb-4\">\n            <label class=\"form-label\">Experience (Years) <span class=\"text-danger\">*</span></label>\n            <input type=\"number\" name=\"experience\" class=\"form-control\" required>\n        </div>\n";

// Hide Salary & Freelance
$html .= "        <div class=\"col-md-3 mb-4\">\n            <label class=\"form-label\">Hide Salary</label><br>\n            <div class=\"form-check form-switch\">\n                <input type=\"checkbox\" name=\"hide_salary\" class=\"form-check-input\" value=\"1\">\n            </div>\n        </div>\n        <div class=\"col-md-3 mb-4\">\n            <label class=\"form-label\">Is Freelance</label><br>\n            <div class=\"form-check form-switch\">\n                <input type=\"checkbox\" name=\"is_freelance\" class=\"form-check-input\" value=\"1\">\n            </div>\n        </div>\n";

// Submit
$html .= "        <div class=\"col-12 d-flex justify-content-end mt-4\">\n            <input type=\"hidden\" name=\"saveAsDraft\" id=\"saveAsDraft\" value=\"\">\n            <button type=\"submit\" name=\"saveDraft\" class=\"btn btn-outline-primary me-3\">Save as Draft</button>\n            <button type=\"submit\" name=\"save\" class=\"btn btn-primary\">Save Job</button>\n        </div>\n    </div>\n</form>\n";

echo $html;
