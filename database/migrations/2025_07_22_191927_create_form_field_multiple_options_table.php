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
        Schema::create('form_field_multiple_options', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('form_field_id');
            $table->foreign('form_field_id')->references('id')->on('form_fields')->onDelete('cascade');

            $table->string('options_value');
            $table->string('options_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_field_multiple_options');
    }
};
