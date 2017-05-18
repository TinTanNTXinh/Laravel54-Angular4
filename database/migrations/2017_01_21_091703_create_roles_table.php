<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->comment('Mã');
            $table->string('name', 100)->comment('Tên');
            $table->text('description')->nullable()->comment('Mô tả');
            $table->string('router_link', 100)->comment('router link cho angular');
            $table->string('icon_name', 100)->comment('icon cho aside');
            $table->integer('index')->default(1)->comment('vị trí thứ tự');
            $table->boolean('active')->default(false)->comment('Kích hoạt');
            $table->integer('group_role_id')->default(0)->comment('Nhóm quyền');
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
        Schema::dropIfExists('roles');
    }
}
