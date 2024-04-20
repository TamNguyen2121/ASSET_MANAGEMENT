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
        Schema::create('equipment_fixes', function (Blueprint $table) {
            $table->id();
            $table->integer('equipment_id');
            $table->dateTime('fix_date');
            $table->integer('fix_type');
            $table->double('price')->nullable();
            $table->text('status_before');
            $table->text('status_after');
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
        Schema::dropIfExists('equipment_fixes');
    }
};
