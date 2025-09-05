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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            $table->string('email')->unique();
            $table->char('phone',11)->nullable();
             // أول حاجة: department_id nullable
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete(); // أو ->onDelete('set null')

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
