<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    protected $connection = 'mysqldh';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bstv', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bstv', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
