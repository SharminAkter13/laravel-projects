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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jobs')->cascadeOnDelete();
            $table->foreignId('seeker_id')->constrained('candidates')->cascadeOnDelete();
            $table->dateTime('applied_date');
            $table->enum('status', ['active', 'expired', 'closed'])->default('active');
            $table->dateTime('resume_submitted');
            $table->text('cover_letter')->nullable();
            $table->timestamps();
            $table->check('resume_submitted <= applied_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
