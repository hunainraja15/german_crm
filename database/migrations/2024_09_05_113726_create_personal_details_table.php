<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('personal_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('first_name')->nullable();
            $table->text('last_name')->nullable();
            $table->text('date_of_birth')->nullable();
            $table->text('nationality')->nullable();
            $table->text('gender')->nullable();
            $table->text('passport_number')->nullable();
            $table->text('passport_issue_date')->nullable();
            $table->text('passport_expiry_date')->nullable();
            $table->text('email_address')->nullable();
            $table->text('phone_number')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('personal_details', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('personal_details');
    }
}
