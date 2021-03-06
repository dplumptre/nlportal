<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('address')->nullable();
            $table->string('role')->nullable();
            $table->string('gender')->nullable();
            $table->string('mobile')->nullable();
            $table->string('dob')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('department')->nullable();
            $table->string('grade')->nullable();
            $table->string('employee_type')->nullable();
            $table->string('job_title')->nullable();
            $table->string('date_of_hire')->nullable();
            $table->integer('entitled')->nullable();
            $table->integer('balance')->nullable();
            $table->bigInteger('department_id')->unsigned()->index();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
