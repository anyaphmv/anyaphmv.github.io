<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;
    protected $table='Vacancy';
    protected $fillable = ['name_job', 'paycheck', 'discription', 'place', 'status_id', 'user_id'];
    protected $primaryKey = 'vacancy_id';
    public function getphones() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getcompany() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getstatus(){
        return $this->belongsTo(Status::class, 'status_id', 'status_id');
    }
    public function resumes(){
        return $this->hasMany(Resume::class, 'name_job', 'vacancy_id');
    }
}
