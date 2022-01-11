<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->string("name", 400);
            $table->string("symbol", 50);
            $table->integer("precision")->default(18);
            $table->string("contract")->nullable();
            $table->double("rate")->default(0);
            $table->double("balance")->default(0);
            $table->string("network")->default("BSC");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tokens');
    }
}
