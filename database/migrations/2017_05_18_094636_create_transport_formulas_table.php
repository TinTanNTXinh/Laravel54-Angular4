<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportFormulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_formulas', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('rule', ['SINGLE', 'RANGE', 'PAIR', 'OIL']);
            $table->string('name');
            $table->string('value1');
            $table->string('value2')->nullable();
            $table->boolean('active')->default(false)->comment('Kích hoạt');
            $table->integer('transport_id')->unsigned();
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
        Schema::dropIfExists('transport_formulas');
    }
}
