<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    use HasFactory;

    protected $table = "allocation";
    protected $fillable = [
        "asset_id",
        "object",
        "reciver_id",
        "created_by",
        "updated_by",
        "allocate_status"
    ];
    public function getEquipment()
    {
        $equipment = Asset::find($this->asset_id);
        if ($equipment) {
            return $equipment;
        } else {
            return "Rỗng";
        }
    }
    public function getEquipmentName()
    {
        $equipment = Asset::find($this->asset_id);
        if ($equipment) {
            return $equipment->getEquipmentCategory();
        } else {
            return "Rỗng";
        }
    }
    public function getEquipmentType()
    {
        $equipment = Asset::find($this->asset_id);
        if ($equipment) {
            $equipment_type = AssetType::find($equipment->asset_type_id);
            if ($equipment_type) {
                return $equipment_type->name;
            } else {
                return "Rỗng";
            }
        }
    }
    public function getUser()
    {
        $user = Employee::find($this->reciver_id);
        if ($user) {
            return $user->name;
        } else {
            return "Rỗng";
        }
    }
    public function equipment()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
