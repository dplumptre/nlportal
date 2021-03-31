<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->timestamps();
            $table->string('department');
            $table->string('grade');
            $table->string('mobile');
            $table->string('leave_type');
            $table->string('reason');
            $table->string('leave_starts');
            $table->string('leave_ends');
            $table->string('working_days_no');
            $table->string('balance')->nullable();
            $table->string('resumption_date');
            $table->string('reliever_name');
            $table->mediumText('leave_address');
            $table->string('signature')->nullable();
            $table->string('unit_head_name');
            $table->string('approval_status')->nullable();
            $table->string('date_unithead_approved')->nullable();
            $table->mediumText('unithead_remark')->nullable();
            $table->string('admin_name')->nullable()->nullable();
            $table->string('admin_approval_status')->nullable();
            $table->string('admin_remark')->nullable();
            $table->string('date_admin_approved')->nullable();
            $table->integer('days_hr_approved')->nullable();
            $table->string('hr_signature')->nullable();
            $table->string('returnee_timestamp')->nullable();
            $table->string('resumed_on')->nullable();
            $table->text('reason_unable')->nullable();
            $table->string('returnee_signature')->nullable();
            $table->string('super_confirm_signature')->nullable();
            $table->string('date_signed')->nullable();
            $table->string('hr_confirm_signature')->nullable();
            $table->integer('allowance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
}
