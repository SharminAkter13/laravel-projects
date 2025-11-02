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
            $table->unsignedBigInteger('employer_id')->after('id');

            // Add foreign key
            $table->foreign('employer_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
    $table->string('title');
    $table->string('location')->nullable();
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
});    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
