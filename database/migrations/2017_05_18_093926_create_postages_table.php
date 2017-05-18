<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->comment('Mã');
            $table->decimal('unit_price', 18, 0)->comment('Đơn giá trên mỗi đơn vị tính');
            $table->decimal('delivery_percent')->comment('Phần trăm giao xe');
            $table->dateTime('apply_date');
            $table->boolean('change_by_fuel')->default(false)->comment('Tạo do nhiên liệu thay đổi');
            $table->text('note')->nullable()->comment('Ghi chú');
            $table->integer('created_by')->default(0)->unsigned()->comment('Người tạo');
            $table->integer('updated_by')->default(0)->unsigned()->comment('Người sửa');
            $table->dateTime('created_date')->default(date('Y-m-d H:i:s'))->comment('Ngày tạo');
            $table->dateTime('updated_date')->nullable()->comment('Ngày cập nhật');
            $table->boolean('active')->default(false)->comment('Kích hoạt');
            $table->integer('customer_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->integer('fuel_id')->unsigned();
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
        Schema::dropIfExists('postages');
    }
}
