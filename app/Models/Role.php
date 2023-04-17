<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table='Role';
    protected $fillable = ['name_role'];
    protected $primaryKey = 'user_role';

    public function users()
    {
        return $this->hasMany(User::class, 'name_role', 'user_role');
    }
}
