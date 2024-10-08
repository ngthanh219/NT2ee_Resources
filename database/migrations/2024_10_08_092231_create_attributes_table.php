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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->comment('Loại tự quy định: 0 là phiên bản, 1 là màu, ...');
            $table->text('description')->nullable()->comment('Mô tả cụ thể cho loại này');
            $table->string('name')->comment('Ví dụ name là 256GB, thì type là 0 chẳng hạn, và mô tả là dung lượng của sản phẩm');
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
        Schema::dropIfExists('attributes');
    }
};
