<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pairs', function (Blueprint $table) {
            $table->id();
            $table->string("name", 18);
            $table->integer("f_token");
            $table->integer("t_token");
            $table->string("price");
            $table->string("network")->default("BSC");
            $table->string("container_name")->nullable();
            $table->integer("container_status")->nullable();
            $table->index(["name", "network"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pairs');
    }
}
