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
        Schema::disableForeignKeyConstraints();
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('order_num')->unique();
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('recipe')->nullable();
            $table->boolean('need_recipe')->default(false);
            $table->boolean('recipe_status')->default(false);
            $table->float('price', 8, 2)->default(0);
            $table->float('total', 8, 2)->default(0);
            $table->integer('quantity')->default(1);
            $table->index(['user_id']);
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
