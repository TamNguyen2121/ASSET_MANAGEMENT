<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetCategory extends Model
{
    use HasFactory;
    protected $table = 'asset_category';
    protected $fillable = [
        'code',
        'name',
        'description',
        'status',
        'created_by',
        'updated_by',
        'asset_type_id',
    ];
    public function getUser(): string
    {
        return Employee::find($this->created_by)->name;
    }
    public function getEquipmentType(): string
    {
        return AssetType::find($this->asset_type_id)->name;
    }
}
