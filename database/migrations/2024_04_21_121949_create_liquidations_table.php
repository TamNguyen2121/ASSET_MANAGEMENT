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
        Schema::create('liquidations', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID key
            $table->string('asset_id'); // Mã tài sản
            $table->string('approval_by')->nullable(); // Người phê duyệt
            $table->tinyInteger('approval_status')->default(1); // Tình trạng phê duyệt
            $table->text('refuse_reason')->nullable(); // Lý do từ chối
            $table->dateTime('liquidation_time')->nullable(); // Thời gian thanh lý
            $table->float('depreciation_value'); // Giá trị khấu hao
            $table->float('price')->nullable(); // Giá thu được (nếu có)
            $table->text('description')->nullable(); // Mô tả
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
        Schema::dropIfExists('liquidations');
    }
};
