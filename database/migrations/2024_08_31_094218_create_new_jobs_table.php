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
        Schema::create('new_jobs', function (Blueprint $table) {
            $table->id();
            $table->text('job_title')->nullable();
            $table->text('job_description')->nullable();
            $table->text('job_location')->nullable();
            $table->text('employment_type')->nullable();
            $table->text('industry')->nullable();
            $table->text('salary_range')->nullable();
            $table->text('application_deadline')->nullable();
            $table->text('required_qualifications')->nullable();
            $table->text('preferred_qualifications')->nullable();
            $table->text('education_level')->nullable();
            $table->text('experience_required')->nullable();
            $table->text('company_name')->nullable();
            $table->text('company_website')->nullable();
            $table->text('company_address')->nullable();
            $table->text('visibility')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_jobs');
    }
};
