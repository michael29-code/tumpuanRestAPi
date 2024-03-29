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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // primary key, auto_increment
            $table->string("username", 100)->nullable(false)->unique("users_username_unique");
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->unsignedBigInteger("role_id")->nullable(false)->default(1);
            $table->string("token", 100)->nullable()->unique("users_token_unique");
            $table->timestamps(); // created_at dan updated_at
            $table->foreign("role_id")->on("roles")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
