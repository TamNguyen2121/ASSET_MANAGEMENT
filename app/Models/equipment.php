<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\supplier as Supplier;
use App\Models\allocation as Allocation;

class Equipment extends Model
{
    use HasFactory;
    protected $table = 'equipment';
    protected $fillable = [
        'code',
        'name_id',
        'price',
        'supplier_id',
        'equipment_type_id',
        'serial',
        'use_status',
        'purchase_date',
        'warranty_period',
        'user_id',
        'description',
        'promissory_code',
        'entry_code',
        'note',
        'status',
        'created_by',
        'updated_by',
    ];
    public function getUser()
    {
        $created_by = User::find($this->created_by);
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
        $equipmentCategory = EquipmentCategory::find($this->name_id);
        if ($equipmentCategory) {
            return $equipmentCategory->name;
        } else {
            return "Rỗng";
        }
    }
    public function getEquipmentType()
    {
        $equipmentCategory = EquipmentType::find($this->equipment_type_id);
        if ($equipmentCategory) {
            return $equipmentCategory->name;
        } else {
            return "Rỗng";
        }
    }
    public function equipmentType()
    {
        return $this->belongsTo(EquipmentCategory::class, 'name_id');
    }
    public function countAllocation()
    {
        return Allocation::where('equipment_id', $this->id)->count();
    }
    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }

}
