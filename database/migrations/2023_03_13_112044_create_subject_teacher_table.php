<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('subject_teacher', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('teacher_id');

            $table->foreign('subject_id')->on('subjects')->references('id');
            $table->foreign('teacher_id')->on('teachers')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('subject_teacher');
    }
};
