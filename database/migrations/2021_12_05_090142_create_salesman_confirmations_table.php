<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesmanConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesman_confirmations', function (Blueprint $table) {
            $table->id();
            $table->string('companey_name');
            $table->string('email');
            $table->text('description');
            $table->string('name');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('salesman_status');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('salesman_confirmations');
    }
}
