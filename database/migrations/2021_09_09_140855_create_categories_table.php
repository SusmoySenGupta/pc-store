<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table)
        {
            $table->unsignedMediumInteger('id', true);
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->nestedSet();
            $table->timestamps();
            $table->softDeletes();
            $table->track(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');

        Schema::table('table', function (Blueprint $table) {
            $table->dropTrack();
        });
    }
}
