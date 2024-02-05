<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('catatan_haids', function (Blueprint $table) {
            $table->id();
            $table->string('start_date', 100)->nullable(false);
            $table->string('end_date', 100)->nullable(false);
            $table->integer('cycle_length')->nullable(false);
            $table->integer('period_length')->nullable(false);
            $table->string('start_prediction_date', 100)->nullable(false);
            $table->string('end_prediction_date', 100)->nullable(false);
            $table->string('status', 100)->nullable(false);
            $table->boolean('reminder_active')->nullable(false);
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->timestamps();

            $table->foreign("user_id")->on("users")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_haids');
    }
};
