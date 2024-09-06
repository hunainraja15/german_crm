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
        Schema::create('visa_details', function (Blueprint $table) {
            $table->id();
            $table->text('visa_type_requested')->nullable();
            $table->text('visa_process_type')->nullable();
            $table->text('work_permit_required')->nullable();
            $table->text('job_offer_signed_date')->nullable();
            $table->text('aisa_application_fee_payment_confirmation')->nullable();
            $table->text('payment_method')->nullable();
            $table->text('fee_waiver')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_details');
    }
};
