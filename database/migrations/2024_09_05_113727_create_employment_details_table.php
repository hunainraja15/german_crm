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
        Schema::create('employment_details', function (Blueprint $table) {
            $table->id();
            $table->text('job_title')->nullable();
            $table->text('job_role')->nullable();
            $table->text('industry')->nullable();
            $table->text('start_date_of_employment')->nullable();
            $table->text('employment_contract_type')->nullable();
            $table->text('salary_offered')->nullable();
            $table->text('working_hours')->nullable();
            $table->text('work_location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_details');
    }
};
