<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->index(['product_type', 'is_approved', 'status', 'id'], 'products_home_type_index');
            $table->index(['category_id', 'id'], 'products_category_index');
            $table->index(['sub_category_id', 'id'], 'products_sub_category_index');
            $table->index(['child_category_id', 'id'], 'products_child_category_index');
        });

        Schema::table('product_reviews', function (Blueprint $table) {
            $table->index('product_id', 'product_reviews_product_id_index');
        });

        Schema::table('flash_sale_items', function (Blueprint $table) {
            $table->index(['show_at_home', 'status', 'product_id'], 'flash_sale_items_home_index');
        });

        Schema::table('order_products', function (Blueprint $table) {
            $table->index(['vendor_id', 'order_id'], 'order_products_vendor_order_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->dropIndex('order_products_vendor_order_index');
        });

        Schema::table('flash_sale_items', function (Blueprint $table) {
            $table->dropIndex('flash_sale_items_home_index');
        });

        Schema::table('product_reviews', function (Blueprint $table) {
            $table->dropIndex('product_reviews_product_id_index');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('products_child_category_index');
            $table->dropIndex('products_sub_category_index');
            $table->dropIndex('products_category_index');
            $table->dropIndex('products_home_type_index');
        });
    }
};
