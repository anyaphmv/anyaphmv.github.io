<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colomn extends Model
{
    use HasFactory;
    protected $table='colomns';
    protected $fillable = ['title'];
    protected $primaryKey = 'id';

    public function resumes()
    {
        return $this->hasMany(Resume::class, 'title', 'id');
    }
}
