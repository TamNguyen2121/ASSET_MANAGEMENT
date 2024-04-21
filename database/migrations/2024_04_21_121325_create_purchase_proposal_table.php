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
        Schema::create('purchase_proposal', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID key
            $table->string('purchase_proposal_code')->unique(); // Mã đề xuất
            $table->string('purchase_proposal_name'); // Tên đề xuất mua hàng
            $table->string('suppose_buy_time'); // Thời gian mua dự kiến
            $table->string('total_money'); // Tổng tiền dự kiến
            $table->string('approval_buy')->nullable(); // Serial
            $table->string('approval_status')->nullable(); // Nhà sản xuất
            $table->string('description')->nullable(); // Tình trạng sử dụng
            $table->string('refuse_reason')->nullable(); // Ngày bảo hành
            $table->tinyInteger('status')->default(1); // Trạng thái
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
        Schema::dropIfExists('purchase_proposal');
    }
};
