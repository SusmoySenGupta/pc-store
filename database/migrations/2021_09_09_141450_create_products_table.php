<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table)
        {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 255)->index();
            $table->string('sku', 255)->unique();

            $table->unsignedMediumInteger('category_id');

            $table->foreignId('brand_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->text('description')->nullable();
            $table->decimal('price', 11, 2);
            $table->integer('stock')->default(0);
            $table->decimal('discount_percentage', 11, 2)->nullable();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->track(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
