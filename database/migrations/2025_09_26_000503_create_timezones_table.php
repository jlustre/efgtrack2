<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('timezones', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. America/New_York
            $table->string('abbreviation')->nullable(); // e.g. EST
            $table->string('utc_offset')->nullable(); // e.g. -05:00
            $table->boolean('is_active')->default(false); 
            $table->timestamps();
            $table->unique('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timezones');
    }
};
