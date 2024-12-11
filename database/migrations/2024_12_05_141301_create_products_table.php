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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('thumb_image');

            $table->text('short_description');
            $table->text('long_description');


            $table->double('price');
            $table->integer('qty');
            $table->boolean('status');

            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('video_link')->nullable();
            $table->string('sku')->nullable();
            $table->double('offer_price')->nullable();
            $table->string('product_type')->nullable();

            $table->integer('is_approved')->default(0); //vendor create  a  product, admin has to approved DONE BACKEND

            $table->date('offer_start_date')->nullable();
            $table->date('offer_end_date')->nullable();

            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('sub_category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('child_category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
