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
        Schema::create('categories', function (Blueprint $table) {
            // SQL 
            // $table->bigInteger('id')->unsigned()->autoIncrement();
            $table->id(); // 1 2 3 4 
            // $table->uuid();
            // VARCAHR 64000
            $table->string('name',255);
            $table->string('slug',255)->unique();
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();

            $table->timestamps();
            // $table->timestamp('created_at'); // 12:02:20 2026-09-14
            // $table->timestamp('updated_at'); // 12:02:20 2026-09-14
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
