<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->comment('Mã');
            $table->string('fullname')->comment('Họ tên');
            $table->string('phone')->nullable()->comment('Điện thoại');
            $table->date('birthday')->nullable()->comment('Ngày sinh');
            $table->enum('sex', ['Nam', 'Nữ', 'Khác'])->comment('Giới tính');
            $table->string('email')->nullable()->comment('Email');

            $table->text('dia_chi_thuong_tru')->nullable();
            $table->text('dia_chi_tam_tru')->nullable();
            $table->text('so_chung_minh')->nullable();
            $table->text('ngay_cap_chung_minh')->nullable();
            $table->text('loai_bang_lai')->nullable();
            $table->text('so_bang_lai')->nullable();
            $table->text('ngay_cap_bang_lai')->nullable();
            $table->text('ngay_het_han_bang_lai')->nullable();

            $table->dateTime('start_date')->default(date('Y-m-d H:i:s'))->comment('Ngày vào làm');
            $table->dateTime('finish_date')->nullable()->comment('Ngày nghĩ việc');
            $table->text('note')->nullable()->comment('Ghi chú');
            $table->integer('created_by')->default(0)->unsigned()->comment('Người tạo');
            $table->integer('updated_by')->default(0)->unsigned()->comment('Người sửa');
            $table->dateTime('created_date')->default(date('Y-m-d H:i:s'))->comment('Ngày tạo');
            $table->dateTime('updated_date')->nullable()->comment('Ngày cập nhật');
            $table->boolean('active')->default(false)->comment('Kích hoạt');
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
        Schema::dropIfExists('drivers');
    }
}
