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
        Schema::create('tongdai', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->string('ip');
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(0);//gia tri mac dinh la 1
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
        Schema::dropIfExists('tongdai');
    }
};
