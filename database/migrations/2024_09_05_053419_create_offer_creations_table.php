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
        Schema::create('offer_creations', function (Blueprint $table) {
            $table->id();
            $table->text('salary')->nullable();
            $table->text('benefits')->nullable();
            $table->text('contractual_terms')->nullable();
            $table->text('signature')->nullable();
            $table->text('employer_signature')->nullable();
            $table->foreignId('interview_id')->constrained()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_creations');
    }
};
