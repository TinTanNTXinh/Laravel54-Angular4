<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->comment('Mã');
            $table->string('name')->comment('Tên');
            $table->text('description')->nullable()->comment('Mô tả');
            $table->text('address')->nullable();
            $table->text('contactor')->nullable();
            $table->text('phone')->nullable();
            $table->text('note')->nullable();
            $table->boolean('active')->default(false)->comment('Kích hoạt');
            $table->integer('garage_type_id')->unsigned();
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
        Schema::dropIfExists('garages');
    }
}
