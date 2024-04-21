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
        Schema::create('repair', function (Blueprint $table) {
            $table->id();
            $table->integer('asset_category_id');
            $table->dateTime('broken_day');
            $table->text('status_before');
            $table->text('status_after');
            $table->integer('repair_type');
            $table->integer('repair_status')->nullable();
            $table->double('price')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair');
    }
};
