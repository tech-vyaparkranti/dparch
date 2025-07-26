<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterGalleryItemsMakeAlternateTextNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gallery_items', function (Blueprint $table) {
            // Remove the default value and make the column nullable
            $table->string('alternate_text', 500)->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_items', function (Blueprint $table) {
            // Revert: Set a default value and make it non-nullable again
            // BE CAREFUL: If the column contains NULL values, this rollback will fail.
            // You might need to update NULLs to 'image' before rolling back.
            $table->string('alternate_text', 500)->default('image')->nullable(false)->change();
        });
    }
}