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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personal_detail_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('employment_detail_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('company_detail_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('visa_detail_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('education_detail_id')->nullable()->constrained()->onDelete('set null');
            $table->text('offer_letter')->nullable();
            $table->text('employment_contract')->nullable();
            $table->text('job_description')->nullable();
            $table->text('company_financials')->nullable();
            $table->text('passport_copy')->nullable();
            $table->text('candidate_qualifications')->nullable();
            $table->text('recognition_certificate')->nullable();
            $table->text('health_insurance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
