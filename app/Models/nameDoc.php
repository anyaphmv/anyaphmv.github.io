<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nameDoc extends Model
{
    use HasFactory;
    protected $table='nameDoc';
    protected $fillable = ['name'];
    protected $primaryKey = 'id_name';
    public function docname()
    {
        return $this->hasMany(Documents::class, 'name', 'id_name');
    }
}
