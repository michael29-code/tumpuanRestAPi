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
        Schema::create('suara_puans', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable(false);
            $table->string('content', 100)->nullable(false);
            $table->string('media', 100)->nullable(false);
            $table->string('dop', 100)->nullable(false);
            $table->unsignedBigInteger("user_id")->nullable(false);
            $table->unsignedBigInteger("kategori_id")->nullable(false);
            $table->timestamps();
            $table->foreign("user_id")->on("users")->references("id");
            $table->foreign("kategori_id")->on("kategori_suara_puans")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suara_puans');
    }
};
