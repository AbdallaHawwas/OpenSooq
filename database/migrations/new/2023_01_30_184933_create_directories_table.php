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
        Schema::create('directories', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description");
            $table->string("img")->nullable();
            $table->string("cover")->nullable();
            $table->integer("category_id")->nullable();
            $table->integer("phone");
            $table->integer("city_id");
            $table->integer("user_id");
            $table->string("address")->nullable();
            $table->integer("type")->default(1); // 1 => Driver - 2 => Company
            $table->string("social")->nullable();
            $table->tinyInteger("active")->default(0);
            $table->string("lang")->default('ar');
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
        Schema::dropIfExists('directories');
    }
};
