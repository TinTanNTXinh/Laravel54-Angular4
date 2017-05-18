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
            $table->increments('id');
            $table->string('code')->unique()->comment('Mã');
            $table->string('fullname')->comment('Họ tên');
            $table->string('username')->nullable()->comment('Tài khoản');
            $table->string('password')->nullable()->comment('Mật khẩu');
            $table->string('address')->nullable()->comment('Địa chỉ');
            $table->string('phone')->nullable()->comment('Điện thoại');
            $table->date('birthday')->nullable()->comment('Ngày sinh');
            $table->enum('sex', ['Nam', 'Nữ', 'Khác'])->comment('Giới tính');
            $table->string('email')->nullable()->comment('Email');
            $table->text('note')->nullable()->comment('Ghi chú');
            $table->integer('created_by')->default(0)->unsigned()->comment('Người tạo');
            $table->integer('updated_by')->default(0)->unsigned()->comment('Người sửa');
            $table->dateTime('created_date')->default(date('Y-m-d H:i:s'))->comment('Ngày tạo');
            $table->dateTime('updated_date')->nullable()->comment('Ngày cập nhật');
            $table->boolean('active')->default(false)->comment('Kích hoạt');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
