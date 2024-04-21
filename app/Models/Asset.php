<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\supplier as Supplier;
use App\Models\allocation as Allocation;

class Asset extends Model
{
    use HasFactory;
    protected $table = 'asset';
    protected $fillable = [
        'code',
        'asset_category_id',
        'price',
        'supplier_id',
        'asset_type_id',
        'serial',
        'use_status',
        'purchase_date',
        'warranty_period',
        'employee_id',
        'asset_description',
        'promissory_code',
        'entry_code',
        'note',
        'status',
        'created_by',
        'updated_by',
    ];
    public function getUser()
    {
        $created_by = Employee::find($this->created_by);
        if ($created_by) {
            return $created_by->name;
        } else {
            return "Rỗng";
        }
    }
    public function getSupplier()
    {
        $supplier = Supplier::find($this->supplier_id);
        if ($supplier) {
            return $supplier->name;
        } else {
            return "Rỗng";
        }
    }
    public function getEquipmentCategory()
    {
        $equipmentCategory = AssetCategory::find($this->asset_category_id);
        if ($equipmentCategory) {
            return $equipmentCategory->name;
        } else {
            return "Rỗng";
        }
    }
    public function getEquipmentType()
    {
        $equipmentCategory = AssetType::find($this->asset_type_id);
        if ($equipmentCategory) {
            return $equipmentCategory->name;
        } else {
            return "Rỗng";
        }
    }
    public function equipmentType()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }
    public function countAllocation()
    {
        return Allocation::where('asset_id', $this->id)->count();
    }
    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }

}
