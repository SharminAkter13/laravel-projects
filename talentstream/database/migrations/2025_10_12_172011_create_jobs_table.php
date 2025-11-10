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

        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('user_email');
            $table->foreignId('employer_id')->nullable()->constrained('employers')->nullOnDelete();
            $table->string('title');
            $table->foreignId('job_location_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('job_type_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('tags')->nullable();
            $table->text('description');
            $table->string('application_email')->nullable();
            $table->string('application_url')->nullable();
            $table->date('closing_date')->nullable();
            $table->string('company_name')->nullable();
            $table->string('website')->nullable();
            $table->string('tagline')->nullable();
            $table->string('cover_image')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->timestamps();
        });  
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
