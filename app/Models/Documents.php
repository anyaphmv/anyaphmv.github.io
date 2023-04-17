<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $table='documents';
    protected $fillable = ['date','id_resume','name_id'];
    protected $primaryKey = 'id';
    public function resum() {
        return $this->belongsTo(Resume::class, 'id_resume', 'resume_id');
    }
    public function names() {
        return $this->belongsTo(nameDoc::class, 'name_id', 'id_name');
    }

}
