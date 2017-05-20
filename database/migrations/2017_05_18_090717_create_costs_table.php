<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->comment('Mã');
            $table->decimal('money', 18, 0)->default(0)->comment('Chi phí');
            $table->decimal('vat')->default(0)->comment();
            $table->decimal('after_vat', 18, 0)->default(0)->comment('Chi phí sau khi có vat');
            $table->enum('type', ['Dầu', 'Nhớt', 'Đậu bãi', 'Khác']);

            $table->integer('fuel_id')->unsigned();
            $table->decimal('quantum_liter')->default(0)->comment('Số lít dầu/nhớt');
            $table->dateTime('refuel_date')->comment('Ngày đổ dầu/nhớt');

            $table->integer('unit_price_park_id')->unsigned();
            $table->dateTime('checkin_date')->comment('Ngày đậu bãi');
            $table->dateTime('checkout_date')->comment('Ngày ra bãi');
            $table->integer('total_day')->comment('Tổng ngày đậu bãi');

            $table->text('note')->nullable()->comment('Ghi chú');
            $table->integer('created_by')->default(0)->unsigned()->comment('Người tạo');
            $table->integer('updated_by')->default(0)->unsigned()->comment('Người sửa');
            $table->dateTime('created_date')->default(date('Y-m-d H:i:s'))->comment('Ngày tạo');
            $table->dateTime('updated_date')->nullable()->comment('Ngày cập nhật');
            $table->boolean('active')->default(false)->comment('Kích hoạt');
            $table->integer('truck_id')->unsigned();
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
        Schema::dropIfExists('costs');
    }
}
