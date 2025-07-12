<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('image', 500)->nullable(false);           // Main image
            $table->string('banner_image', 500)->nullable(true);     // Banner image
            $table->string('project_name', 255)->nullable(false);    // Project/Service name
            $table->longText('description')->nullable(true);         // Description/content
            $table->json('gallery_images')->nullable(true);          // Multiple images as JSON array
            $table->enum('status', ['live', 'disabled'])->default('disabled');
            $table->integer('sorting')->default(1)->index('services_sorting_index');
            $table->bigInteger("created_by")->nullable(true);
            $table->bigInteger("updated_by")->nullable(true);
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
        Schema::dropIfExists('services');
    }
}
