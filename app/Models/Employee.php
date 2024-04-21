<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'employee';
    protected $fillable = [
        'name',
        'email',
        'password',
        'code',
        'date_of_birth',
        'identity_card',
        'address',
        'phone_number',
        'user_name',
        'status',
        'created_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
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
