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
        Schema::create('riders', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->tinyInteger("country");
            $table->tinyInteger("city");
            $table->integer("user_id");
            $table->string("email")->nullable();
            $table->integer("phone");
            $table->tinyInteger("rate")->default(0);
            $table->tinyInteger("active")->default(0); // 0 for non-active - 1 for Active;
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
        Schema::dropIfExists('riders');
    }
};
