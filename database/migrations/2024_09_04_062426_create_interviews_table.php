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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->text('interview_type')->nullable();
            $table->text('interview_date')->nullable();
            $table->text('interview_time_start')->nullable();
            $table->text('interview_time_end')->nullable();
            $table->text('duration')->nullable();
            $table->text('special_request')->nullable();
            $table->string('status')->default('panding');
            $table->string('signature')->default(false);
            $table->foreignId('application_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
