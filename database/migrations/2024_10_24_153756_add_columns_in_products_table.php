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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('is_new')->default(config('base.is_new.no'))->after('description');
            $table->integer('is_hot')->default(config('base.is_hot.no'))->after('is_new');
            $table->integer('is_best_seller')->default(config('base.is_best_seller.no'))->after('is_hot');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('is_best_seller');
            $table->dropColumn('is_hot');
            $table->dropColumn('is_new');
        });
    }
};
