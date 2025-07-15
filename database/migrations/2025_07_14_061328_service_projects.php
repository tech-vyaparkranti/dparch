<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ServiceProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table ->string('service_name');
            $table ->string('image');
            $table ->enum('status',['live','disable']);
            $table->integer('sorting');
            $table->string('slug')->unique();
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
        Schema::drop('service_projects');
    }
}
