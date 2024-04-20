<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    use HasFactory;
    protected $table = 'equipment_types';
    protected $fillable = [
        'code',
        'name',
        'created_by',
        'updated_by',
        'status',
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
}
