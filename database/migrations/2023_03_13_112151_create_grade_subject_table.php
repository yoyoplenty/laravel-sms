<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('grade_subject', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('subject_id');

            $table->foreign('grade_id')->on('grades')->references('id')->onDelete('cascade');
            $table->foreign('subject_id')->on('subjects')->references('id')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('grade_subject');
    }
};
