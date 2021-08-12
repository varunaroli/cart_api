<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                ->comment('FK: products table')
                ->nullable()
                ->constrained("products")
                ->nullOnDelete();
            $table->integer('price');
            $table->integer('quantity');
            $table->float('discount');
            $table->float('total');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `cart` comment 'Store cart items'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
