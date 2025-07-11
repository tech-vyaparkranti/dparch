<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhyChooseUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('why_choose_us', function (Blueprint $table) {
        $table->id();
        $table->string('icon')->nullable();
        $table->string('title');
        $table->string('status')->default('live'); // <-- CHANGE HERE
        $table->integer('sorting')->nullable();
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
        Schema::dropIfExists('why_choose_us');
    }
}
