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
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID key
            $table->integer('asset_id'); // Mã tài sản
            $table->string('maintenance_date_schedule'); // Thời gian bảo trì theo lịch
            $table->string('maintenance_date')->nullable(); // Thời gian bảo trì thực tế
            $table->string('maintenance_status'); // Trạng thái bảo trì
            $table->string('maintenance_by')->nullable(); // Đơn vị bảo trì
            $table->dateTime('create_time'); // Thời gian tạo
            $table->string('create_by'); // Người tạo
            $table->dateTime('update_time')->nullable(); // Thời gian chỉnh sửa
            $table->string('update_by')->nullable(); // Người chỉnh sửa
            $table->timestamps(); // Thêm cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};
