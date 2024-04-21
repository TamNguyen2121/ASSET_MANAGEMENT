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
        Schema::create('purchase_proposal_detail', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID key
            $table->string('asset_category_id'); // Mã loại tài sản
            $table->string('quantity'); // Số lượng dự kiến
            $table->string('estimate_price'); // Đơn giá dự kiến
            $table->tinyInteger('status')->default(1); // Trạng thái
            $table->dateTime('create_time'); // Thời gian tạo
            $table->string('create_by'); // Người tạo
            $table->dateTime('update_time'); // Thời gian chỉnh sửa
            $table->string('update_by'); // Người chỉnh sửa
            $table->timestamps(); // Thêm cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_proposal_detail');
    }
};
