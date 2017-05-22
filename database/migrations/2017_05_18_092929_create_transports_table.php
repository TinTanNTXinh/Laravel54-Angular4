<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->comment('Mã');
            $table->dateTime('transport_date')->comment('Ngày vận chuyển');
            $table->enum('type1', ['NORMAL', 'BLANK'])->comment('Đơn hàng thường hay khống');
            $table->enum('type2', [
                '',
                'CUSTOMER-HD-NOTFULL',
                'CUSTOMER-HD-FULL',
                'CUSTOMER-PTT-NOTFULL',
                'CUSTOMER-PTT-FULL'
            ])->comment('Đã xuất cho khách hàng - HĐ hoặc PTT - Xuất đủ hay chưa');
            $table->enum('type3', [
                '',
                'GARAGE-PTT-FULL'
            ])->comment('Đã xuất cho nhà xe - PTT - Xuất đủ');
            $table->integer('quantum_product')->comment('Số lượng sản phẩm');
            $table->decimal('revenue', 18, 0)->comment('Doanh thu');
            $table->decimal('profit', 18, 0)->comment('Lợi nhuận');
            $table->decimal('receive', 18, 0)->comment('Nhận');
            $table->decimal('delivery', 18, 0)->comment('Giao xe');
            $table->decimal('carrying', 18, 0)->comment('Bốc xếp');
            $table->decimal('parking', 18, 0)->comment('Neo đêm');
            $table->decimal('fine', 18, 0)->comment('Công an');
            $table->decimal('phi_tang_bo', 18, 0)->comment('Phí tăng bo');
            $table->decimal('add_score', 18, 0)->comment('Thêm điểm');
            $table->decimal('delivery_real', 18, 0)->comment('Giao xe thực tế');
            $table->decimal('carrying_real', 18, 0)->comment('Bốc xếp thực tế');
            $table->decimal('parking_real', 18, 0)->comment('Neo đêm thực tế');
            $table->decimal('fine_real', 18, 0)->comment('Công an thực tế');
            $table->decimal('phi_tang_bo_real', 18, 0)->comment('Phí tăng bo thực tế');
            $table->decimal('add_score_real', 18, 0)->comment('Thêm điểm thực tế');

            $table->string('voucher_number')->comment('Số chứng từ');
            $table->string('quantum_product_on_voucher')->comment('Số lượng sản phẩm trên chứng từ');
            $table->string('receiver')->comment('Người nhận');

            $table->text('note')->nullable()->comment('Ghi chú');
            $table->integer('created_by')->default(0)->unsigned()->comment('Người tạo');
            $table->integer('updated_by')->default(0)->unsigned()->comment('Người sửa');
            $table->dateTime('created_date')->default(date('Y-m-d H:i:s'))->comment('Ngày tạo');
            $table->dateTime('updated_date')->nullable()->comment('Ngày cập nhật');
            $table->boolean('active')->default(false)->comment('Kích hoạt');
            $table->integer('truck_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('postage_id')->unsigned();
            $table->integer('fuel_id')->unsigned()->comment('Mã giá dầu nếu trong công thức có giá dầu');
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
        Schema::dropIfExists('transports');
    }
}
