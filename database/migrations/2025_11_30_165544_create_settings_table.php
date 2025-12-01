<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('settings'); // Safety drop if old one exists

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // E.g., 'system_name', 'currency'
            $table->text('value')->nullable(); // E.g., 'My WMS', '$'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
