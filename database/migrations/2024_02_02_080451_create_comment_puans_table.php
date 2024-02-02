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
        Schema::create('comment_puans', function (Blueprint $table) {
            $table->id();
            $table->string('comment', 255)->nullable(false);
            $table->string('dop', 255)->nullable(false);

            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('suarapuan_id')->nullable(false);

            $table->timestamps();

            $table->foreign('user_id')->on("users")->references('id');
            $table->foreign('suarapuan_id')->on("suara_puans")->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_puans');
    }
};
