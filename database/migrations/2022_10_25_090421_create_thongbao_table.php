<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thongbaos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('admin_id');
            $table->text('to');
            $table->text('content');
            $table->text('seen');//tinh trang xem cua tung nguoi
            $table->tinyInteger('status')->default(1);//gia tri mac dinh la 1
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
        Schema::dropIfExists('thongbaos');
    }
};
