<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateServicesTableAddSectionsAndRemoveUnusedFields extends Migration
{
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            // Add new 'sections' column
            $table->json('sections')->nullable()->after('description');

            // Drop old columns
            $table->dropColumn(['image', 'gallery_images']);
        });
    }

    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            // Re-add dropped columns
            $table->string('image', 500)->nullable(false);
            $table->json('gallery_images')->nullable();

            // Remove 'sections' column
            $table->dropColumn('sections');
        });
    }
}
