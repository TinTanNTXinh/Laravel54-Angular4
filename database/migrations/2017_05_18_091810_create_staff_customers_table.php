<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->comment('Mã');
            $table->string('fullname')->comment('Họ tên');
            $table->string('address')->nullable()->comment('Địa chỉ');
            $table->string('phone')->nullable()->comment('Điện thoại');
            $table->date('birthday')->nullable()->comment('Ngày sinh');
            $table->enum('sex', ['Nam', 'Nữ', 'Khác'])->comment('Giới tính');
            $table->string('email')->nullable()->comment('Email');
            $table->string('position')->comment('Chức vụ');
            $table->boolean('active')->default(false)->comment('Kích hoạt');
            $table->integer('customer_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_customers');
    }
}
