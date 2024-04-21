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
        Schema::create('asset', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable(); // mã tài sản
            $table->integer('asset_category_id')->nullable(); // mã loại tài sản
            $table->integer('supplier_id')->nullable(); // nhà cung cấp
            $table->string('entry_code')->nullable(); // mã nhập
            $table->string('promissory_code')->nullable(); // phiếu nhập
            $table->integer('price')->nullable(); // nhà cung cấp
            $table->integer('asset_type_id')->nullable(); // loại tài sản
            $table->string('serial')->nullable(); // số seri
            $table->integer('use_status')->nullable(); // trạng thái tài sản
            $table->date('purchase_date')->nullable(); // ngày mua
            $table->date('warranty_period')->nullable(); // hạn bảo hành
            $table->integer('employee_id')->nullable(); // người mua
            $table->text('asset_description')->nullable(); // mô tả tài sản
            $table->text('note')->nullable(); // ghi chú
            $table->integer('status')->nullable(); //trạng thái (hoạt động / ngừng hoạt động)
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset');
    }
};
