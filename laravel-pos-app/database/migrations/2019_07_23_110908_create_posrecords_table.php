<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosrecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posrecords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('customer_id');
            $table->string('customers_name');
            $table->string('amount');
            $table->string('card_number');
            $table->string('trans_id');
            $table->string('terminal_location');
            $table->string('bank');
            $table->string('trans_date');
            $table->string('action_taken');
            $table->string('remarks');
            $table->string('avater')->default('default.jpg');
    
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
        Schema::dropIfExists('posrecords');
    }
}
