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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_num', 50); //order number dynamic
//            $table->string('title');
//            $table->text('desc');
            $table->string('status')->default('pending');
            $table->string('payment_type')->nullable(); //cash ,online
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('address_id')->nullable()->constrained()->onDelete('cascade');
            $table->dateTime('delivery_date')->nullable();
            $table->double('total', 9, 2)->default(0);

//            $table->unsignedBigInteger('provider_id')->index()->nullable();
//            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');

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
        Schema::dropIfExists('orders');
    }
};
