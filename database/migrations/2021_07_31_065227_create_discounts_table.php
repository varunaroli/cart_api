<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id();
            $table->foreignId('product_id')
                ->comment('FK: products table')
                ->nullable()
                ->constrained("products")
                ->nullOnDelete();
            $table->integer('min_value')->comment('For cart it will be total amount and for product it will be quantity');
            $table->integer('max_value')->comment('For cart it will be total amount and for product it will be quantity');
            $table->float('discount_amount');
            $table->tinyInteger('discount_type')->comment('0 - Product discount, 1 - Cart discount');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `discounts` comment 'Store discounts'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
