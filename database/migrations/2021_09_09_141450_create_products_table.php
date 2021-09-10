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
            
            $table->foreignId('category_sub_category_id')
                ->constrained('category_sub_category')
                ->cascadeOnDelete();

            $table->foreignId('brand_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->text('description')->nullable();
            $table->decimal('price', 11, 2);
            $table->integer('stock')->default(0);
            $table->decimal('discount_percentage', 11, 2)->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

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
