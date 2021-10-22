<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table)
        {
            $table->id();
            
            $table->foreignId('user_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

            $table->string('user_name');
            $table->decimal('total_amount', 11, 2);
            $table->string('billing_address');
            $table->string('shipping_address');
            $table->boolean('is_delivered')->default(false);
            $table->boolean('delivered_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
