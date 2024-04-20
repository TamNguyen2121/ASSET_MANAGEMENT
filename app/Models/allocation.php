<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class allocation extends Model
{
    use HasFactory;

    protected $table = "allocations";
    protected $fillable = [
        "equipment_id",
        "object",
        "reciver_id",
        "created_by",
        "updated_by",
        "status"
    ];
    public function getEquipment()
    {
        $equipment = Equipment::find($this->equipment_id);
        if ($equipment) {
            return $equipment;
        } else {
            return "Rỗng";
        }
    }
    public function getEquipmentName()
    {
        $equipment = Equipment::find($this->equipment_id);
        if ($equipment) {
            return $equipment->getEquipmentCategory();
        } else {
            return "Rỗng";
        }
    }
    public function getEquipmentType()
    {
        $equipment = Equipment::find($this->equipment_id);
        if ($equipment) {
            $equipment_type = EquipmentType::find($equipment->equipment_type_id);
            if ($equipment_type) {
                return $equipment_type->name;
            } else {
                return "Rỗng";
            }
        }
    }
    public function getUser()
    {
        $user = User::find($this->reciver_id);
        if ($user) {
            return $user->name;
        } else {
            return "Rỗng";
        }
    }
    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }
}
