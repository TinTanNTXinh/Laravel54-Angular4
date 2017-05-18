<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transport_id')->unsigned();
            $table->integer('invoice_id')->unsigned();
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
        Schema::dropIfExists('transport_invoices');
    }
}
