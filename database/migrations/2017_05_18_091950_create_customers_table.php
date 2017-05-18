<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->comment('Mã');
            $table->string('fullname')->comment('Họ tên');
            $table->string('address')->nullable()->comment('Địa chỉ');
            $table->string('phone')->nullable()->comment('Điện thoại');
            $table->string('email')->nullable()->comment('Email');
            $table->decimal('limit_oil')->default(0)->comment('Số phần trăm khi giá dầu đạt mức này sẽ đổi cước phí');
            $table->decimal('oil_per_postage')->default(0)->comment('Số phần trăm giá dầu/cước phí');
            $table->text('note')->nullable()->comment('Ghi chú');
            $table->integer('created_by')->default(0)->unsigned()->comment('Người tạo');
            $table->integer('updated_by')->default(0)->unsigned()->comment('Người sửa');
            $table->dateTime('created_date')->default(date('Y-m-d H:i:s'))->comment('Ngày tạo');
            $table->dateTime('updated_date')->nullable()->comment('Ngày cập nhật');
            $table->boolean('active')->default(false)->comment('Kích hoạt');
            $table->integer('customer_type_id')->unsigned();
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
        Schema::dropIfExists('customers');
    }
}
