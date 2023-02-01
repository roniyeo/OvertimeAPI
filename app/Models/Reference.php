<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'expression',
    ];
    
    public function employee(){
        return $this->hasMany('App\Models\Employee');
    }
}
