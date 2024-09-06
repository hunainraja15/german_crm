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
        Schema::create('profile_files', function (Blueprint $table) {
            $table->id();
            $table->text('upload_videointerview')->nullable();
            $table->text('resume')->nullable();
            $table->text('cover_letter')->nullable();
            $table->text('qualification_documents')->nullable();
            $table->text('language_certificates')->nullable();
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_files');
    }
};
