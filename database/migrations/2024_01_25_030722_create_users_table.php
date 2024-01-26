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
            $table->string('username')->notNull();
            $table->string('email')->notNull();
            $table->string('password')->notNull();
            $table->string('name')->notNull();
            $table->string('gender')->notNull();
            $table->date('dob')->notNull();
            $table->integer('role')->notNull(); // bukan auto_increment, bukan primary key
            $table->string('token')->nullable();
            $table->timestamps(); // created_at dan updated_at
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
