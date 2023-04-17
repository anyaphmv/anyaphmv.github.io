<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table='Status';
    protected $fillable = ['status'];
    protected $primaryKey = 'status_id';

    public function statuses() {
        return $this->belongsTo(Vacancy::class, 'status', 'status_id');
    }
}
