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
        Schema::create('products_traslations', function (Blueprint $table) {
            $table->id();
            $table->integer('products_id')->unsigned();

            $table->string('name');

            $table->string('description');

            $table->string('locale')->index();

            $table->unique(['products_id', 'locale']);

            $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_traslations');
    }
};
