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
        Schema::create('tbl_favorites', function (Blueprint $table) {
            $table->id(); // Khóa chính tự tăng
            $table->unsignedInteger('customer_id'); // Khóa ngoại tới tbl_customers
            $table->unsignedInteger('product_id'); // Khóa ngoại tới tbl_product
            $table->timestamps();

            // Khóa ngoại tham chiếu tới tbl_customers.customer_id
            $table->foreign('customer_id')
                  ->references('customer_id')
                  ->on('tbl_customers')
                  ->onDelete('cascade');

            // Khóa ngoại tham chiếu tới tbl_product.product_id
            $table->foreign('product_id')
                  ->references('product_id')
                  ->on('tbl_product')
                  ->onDelete('cascade');
        });
   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_favorites');
    }
};
