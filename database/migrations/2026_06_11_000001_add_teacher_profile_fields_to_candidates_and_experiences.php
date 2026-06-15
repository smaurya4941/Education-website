<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->json('teaching_certifications')->nullable()->after('available_at');
            $table->json('teaching_subjects')->nullable()->after('teaching_certifications');
            $table->json('spoken_languages')->nullable()->after('teaching_subjects');
            $table->json('grade_levels')->nullable()->after('spoken_languages');
            $table->json('instruction_mediums')->nullable()->after('grade_levels');
            $table->json('teaching_modes')->nullable()->after('instruction_mediums');
            $table->json('available_days')->nullable()->after('teaching_modes');
            $table->string('preferred_shift')->nullable()->after('available_days');
            $table->string('employment_type')->nullable()->after('preferred_shift');
            $table->string('relocation_preference')->nullable()->after('employment_type');
            $table->text('teaching_bio')->nullable()->after('relocation_preference');
        });

        Schema::table('candidate_experiences', function (Blueprint $table) {
            $table->string('institution_type')->nullable()->after('company');
        });
    }

    public function down(): void
    {
        Schema::table('candidate_experiences', function (Blueprint $table) {
            $table->dropColumn('institution_type');
        });

        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn([
                'teaching_certifications',
                'teaching_subjects',
                'spoken_languages',
                'grade_levels',
                'instruction_mediums',
                'teaching_modes',
                'available_days',
                'preferred_shift',
                'employment_type',
                'relocation_preference',
                'teaching_bio',
            ]);
        });
    }
};
