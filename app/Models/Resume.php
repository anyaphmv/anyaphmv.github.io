<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;
    protected $table='Resume';
    protected $fillable = ['FIO', 'Staff', 'Stage', 'Phone', 'Discription','colom_id','id_vac'];
    protected $primaryKey = 'resume_id';
    public function coloms() {
        return $this->belongsTo(Colomn::class, 'colom_id', 'id');
    }
    public function vacancy() {
        return $this->belongsTo(Vacancy::class, 'colom_id', 'vacancy_id');
    }
    public function docs()
    {
        return $this->hasMany(Documents::class, 'FIO', 'resume_id');
    }
}
