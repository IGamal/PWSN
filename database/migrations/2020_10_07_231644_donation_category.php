<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DonationCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_donation', function (Blueprint $table) {

            $table->bigInteger('donation_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();

            $table->foreign('donation_id')->references('id')->on('donations');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_donation');
    }
}
