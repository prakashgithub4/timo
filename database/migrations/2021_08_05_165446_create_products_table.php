<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('handle');
            $table->string('title');
            $table->text('body');
            $table->string('vendor');
            $table->string('type');
            $table->string('tags');
            $table->string('published');
            $table->string('option1_name')->nullable();
            $table->string('option1_value')->nullable();
            $table->string('option2_name')->nullable();
            $table->string('option2_value')->nullable();
            $table->string('option3_name')->nullable();
            $table->string('option3_value')->nullable();
            $table->string('variant_SKU')->nullable(); 
            $table->string('variant_grams')->default(0)->change();
            $table->string('variant_inventory_tracker')->nullable(); 
            $table->string('variant_inventory_qty')->nullable(); 
            $table->string('variant_inventory_policy')->nullable(); 
            $table->string('variant_fulfillment_service')->nullable();
            $table->float('variant_price')->nullable();
            $table->float('variant_compare_at_price')->nullable();
            $table->string('variant_requires_shipping')->nullable(); 
            $table->enum('variant_taxable',['true','false'])->nullable();
            $table->string('variant_barcode')->nullable();
            $table->string('image_src')->nullable();
            $table->integer('image_position')->nullable();
            $table->string('image_alt_text')->nullable();
            $table->string('gift_card')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('google_product_category')->nullable();
            $table->string('gender')->nullable();
            $table->string('age_group')->nullable();
            $table->string('mpn')->nullable();
            $table->string('adWords_grouping')->nullable();
            $table->string('adWords_labels')->nullable();
            $table->string('condition')->nullable();
            $table->string('custom_product')->nullable();
            $table->string('custom_label_0')->nullable();
            $table->string('custom_label_1')->nullable();
            $table->string('custom_label_3')->nullable();
            $table->string('custom_label_4')->nullable();
            $table->string('variant_image')->nullable();
            $table->string('variant_weight_unit')->nullable();
            $table->string('variant_tax_code')->nullable();
            $table->float('cost_per_item')->nullable();
            $table->unsignedBigInteger('userId')->nullable();
            $table->timestamps();
            $table->foreign('userId')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
