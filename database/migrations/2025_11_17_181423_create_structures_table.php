<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('structures', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('position'); 
            $table->enum('group_type', ['teras', 'division'])->index();
            $table->string('division_name')->nullable(); 
            $table->unsignedTinyInteger('level')->default(3);
            $table->integer('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('structures');
    }
};