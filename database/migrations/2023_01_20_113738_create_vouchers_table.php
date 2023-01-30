<?php

use Carbon\Carbon;
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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string("code");
            $table->string("name");
            $table->integer("amount")->min(1)->max(100)->comment("amount in percentage 1 - 100");
            $table->string("special_user")->comment("0 => All Users, user_id")->default(0);
            $table->boolean("include_shipping")->comment("0 => false,1 => true")->default(0);
            $table->date("starts_from");
            $table->date("ends_at");
            $table->json("history")->default(json_encode(array()));
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
        Schema::dropIfExists('vouchers');
    }
};
