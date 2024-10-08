<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');
            $table->text('attribute_ids')->nullable();
            $table->integer('quantity')->default(0);
            $table->double('price')->default(0)->comment('Giá gốc');
            $table->double('sale_percent')->default(0)->comment("Khuyến mãi");
            $table->double('sale_price')->default(0)->comment("Giá khuyến mãi");
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
        Schema::dropIfExists('product_prices');
    }
};
