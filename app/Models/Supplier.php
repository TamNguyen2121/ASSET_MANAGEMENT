<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $fillable = [
        'code',
        'name',
        'address',
        'phone_number',
        'status',
        'note',
        'tax_code',
        'created_by',
        'updated_by',
        'email'
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
    public function scopeNameSearch($query, $value)
    {
        $query->where('name', 'like', '%' . $value . '%');
    }
}
