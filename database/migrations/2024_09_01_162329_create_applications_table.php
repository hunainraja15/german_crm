<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->text('full_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->text('phone_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->text('street_address')->nullable();
            $table->text('city')->nullable();
            $table->text('state')->nullable();
            $table->text('postal_code')->nullable();
            $table->text('country')->nullable();
            $table->text('linkedin_profile')->nullable();
            $table->text('portfolio_website')->nullable();
            $table->text('professional_summary')->nullable();
            $table->text('education_level')->nullable();
            $table->text('institution_name')->nullable();
            $table->text('field_of_study')->nullable();
            $table->date('graduation_date')->nullable();
            $table->text('job_title')->nullable();
            $table->text('company_name')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('responsibilities')->nullable();
            $table->text('key_skills')->nullable();
            $table->text('certifications')->nullable();
            $table->enum('job_type', ['Full-time', 'Part-time', 'Contract', 'Internship'])->nullable();
            $table->text('preferred_location')->nullable();
            $table->text('desired_salary')->nullable();
            $table->text('languages_spoken')->nullable();
            $table->enum('proficiency_level', ['Basic', 'Intermediate', 'Advanced', 'Fluent', 'Native'])->nullable();
            $table->text('why_this_job')->nullable();
            $table->enum('willing_to_relocate', ['Yes', 'No'])->nullable();
            $table->date('availability_to_start')->nullable();
            $table->boolean('terms')->nullable();
            $table->boolean('privacy')->nullable();
            $table->text('resume')->nullable();
            $table->text('cover_letter')->nullable();
            $table->text('salary_demand')->nullable();
            $table->string('status')->default('disapprove');
            $table->foreignId('job_id')->constrained()->nullable();
            $table->foreignId('user_id')->constrained()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
