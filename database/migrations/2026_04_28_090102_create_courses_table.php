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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->onDelete('cascade');
            $table->foreignId('semester_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('score_course')->default(0);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
