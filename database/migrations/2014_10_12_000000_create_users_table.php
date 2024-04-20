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
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('identity_card')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('account_code')->nullable();
            $table->integer('status')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->integer('created_by')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
