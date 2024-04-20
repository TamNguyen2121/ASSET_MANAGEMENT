<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable = [
        'code',
        'name',
        'address',
        'phone_number',
        'status',
        'note',
        'tax',
        'created_by',
        'updated_by',
        'email'
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
    public function scopeNameSearch($query, $value)
    {
        $query->where('name', 'like', '%' . $value . '%');
    }
}
