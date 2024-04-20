<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentCategory extends Model
{
    use HasFactory;
    protected $table = 'equipment_categories';
    protected $fillable = [
        'code',
        'name',
        'description',
        'status',
        'created_by',
        'updated_by',
        'equipment_type_id',
    ];
    public function getUser(): string
    {
        return User::find($this->created_by)->name;
    }
    public function getEquipmentType(): string
    {
        return EquipmentType::find($this->equipment_type_id)->name;
    }
}
