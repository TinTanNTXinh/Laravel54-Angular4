<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGarageTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garage_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->comment('Mã');
            $table->string('name')->comment('Tên');
            $table->text('description')->nullable()->comment('Mô tả');
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
        Schema::dropIfExists('garage_types');
    }
}
