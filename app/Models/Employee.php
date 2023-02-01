<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status_id',
        'salary',
    ];

    public function overtime(){
        return $this->hasMany('App\Models\Overtime');
    }

    public function reference(){
        return $this->belongsTo('App\Models\Reference', 'status_id');
    }
}
