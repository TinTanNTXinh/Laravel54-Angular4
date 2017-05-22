<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->comment('Mã');
            $table->enum('type1', ['NORMAL', 'BLANK'])->comment('HĐ or PTT thường hay khống');
            $table->enum('type2', ['', 'CUSTOMER-HD', 'CUSTOMER-PTT'])->comment('Hóa đơn KH - PTT KH');
            $table->enum('type3', ['', 'GARAGE-PTT'])->comment('PTT nhà xe');

            $table->integer('customer_id')->unsigned();
            $table->decimal('total_revenue', 18, 0)->comment('Tổng doanh thu');
            $table->decimal('total_receive', 18, 0)->comment('Tổng doanh thu');
            $table->decimal('vat')->comment('vat');
            $table->decimal('after_vat', 18, 0)->comment('Tổng tiền sau vat');

            $table->integer('truck_id')->unsigned();
            $table->decimal('total_delivery', 18, 0)->comment('Tổng doanh thu');
            $table->decimal('total_cost', 18, 0)->comment('Tổng doanh thu');
            $table->decimal('total_cost_in_transport', 18, 0)->comment('Tổng doanh thu');

            $table->decimal('total_pay', 18, 0)->comment('Tổng doanh thu');
            $table->decimal('total_paid', 18, 0)->comment('Tổng doanh thu');
            $table->dateTime('invoice_date');
            $table->string('receiver');
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
        Schema::dropIfExists('invoices');
    }
}
