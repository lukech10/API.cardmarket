<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class card extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'string';
    protected $hidden = ['updated_at','created_at'];

     public function ventas(){
        return $this->hasMany(venta::class);
    }
}