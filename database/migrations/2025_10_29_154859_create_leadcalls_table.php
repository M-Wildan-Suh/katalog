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
        Schema::create('leadcalls', function (Blueprint $table) {
            $table->id();

            // Number
            $table->string('no_tlp')->nullable();
            $table->string('no_wa')->nullable();

            // Color
            $table->string('tlp_color')->nullable();
            $table->string('wa_color')->nullable();

            // Text
            $table->string('tlp_button_text')->nullable();
            $table->string('wa_button_text')->nullable();
            $table->string('wa_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leadcalls');
    }
};
