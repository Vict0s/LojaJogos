<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void { Schema::create('games', function (Blueprint $table) { $table->id(); $table->foreignId('category_id')->constrained()->cascadeOnDelete(); $table->string('title'); $table->string('slug')->unique(); $table->text('description'); $table->string('platform', 80); $table->decimal('price', 8, 2); $table->string('image_url', 2048)->nullable(); $table->date('release_date')->nullable(); $table->timestamps(); $table->index(['category_id', 'title']); }); }
    public function down(): void { Schema::dropIfExists('games'); }
};
