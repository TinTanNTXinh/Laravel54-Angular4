<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->comment('Mã');
            $table->string('area_code')->comment('Mã vùng');
            $table->string('number_plate')->comment('Số xe');
            $table->string('trademark')->comment('Hãng xe');
            $table->integer('year_of_manufacture')->comment('Năm sản xuất');
            $table->string('owner')->comment('Chủ xe');
            $table->integer('length')->comment('Dài');
            $table->integer('width')->comment('Rộng');
            $table->integer('height')->comment('Cao');
            $table->enum('status', ['Chưa phân tài', 'Đang giao hàng', 'Đã giao hàng', 'Không giao được']);
            $table->text('note')->nullable()->comment('Ghi chú');
            $table->integer('created_by')->default(0)->unsigned()->comment('Người tạo');
            $table->integer('updated_by')->default(0)->unsigned()->comment('Người sửa');
            $table->dateTime('created_date')->default(date('Y-m-d H:i:s'))->comment('Ngày tạo');
            $table->dateTime('updated_date')->nullable()->comment('Ngày cập nhật');
            $table->boolean('active')->default(false)->comment('Kích hoạt');
            $table->integer('truck_type_id')->unsigned();
            $table->integer('garage_id')->unsigned();
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
        Schema::dropIfExists('trucks');
    }
}
