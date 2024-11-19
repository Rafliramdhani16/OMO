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
        Schema::create('shirts', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug');
            $table->string('thumbnail');
            $table->text('about');
            // unsigned jadi tidak bisa negative
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('stock');
            $table->boolean('is_popular');
            // merelasikan model
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            // nullable jadi bisa NULL
            $table->foreignId('brand_id')->nullable()->constrained()->cascadeOnDelete();
            // mengahpus sementara jadi hanya ilang di antar muka saja 
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shirts');
    }
};
