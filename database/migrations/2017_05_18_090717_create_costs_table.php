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
            $table->enum('type', ['OIL', 'LUBE', 'PARK', 'OTHER']);
            $table->decimal('vat')->default(0)->comment();
            $table->decimal('after_vat', 18, 0)->default(0)->comment('Tổng chi phí (Chi phí sau khi có vat)');

            // Oil, Lube
            $table->integer('fuel_id')->nullable()->unsigned();
            $table->decimal('quantum_liter')->default(0)->nullable()->comment('Số lít dầu/nhớt');
            $table->dateTime('refuel_date')->nullable()->comment('Ngày đổ dầu/nhớt');

            // Park
            $table->integer('unit_price_park_id')->nullable()->unsigned();
            $table->dateTime('checkin_date')->nullable()->comment('Ngày đậu bãi');
            $table->dateTime('checkout_date')->nullable()->comment('Ngày ra bãi');
            $table->integer('total_day')->nullable()->comment('Tổng ngày đậu bãi');

            $table->text('note')->nullable()->comment('Ghi chú');
            $table->integer('created_by')->default(0)->unsigned()->comment('Người tạo');
            $table->integer('updated_by')->default(0)->unsigned()->comment('Người sửa');
            $table->dateTime('created_date')->default(date('Y-m-d H:i:s'))->comment('Ngày tạo');
            $table->dateTime('updated_date')->nullable()->comment('Ngày cập nhật');
            $table->boolean('active')->default(false)->comment('Kích hoạt');
            $table->integer('truck_id')->unsigned();
            $table->integer('invoice_id')->unsigned();
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
