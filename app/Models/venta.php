<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    use HasFactory;

    public function card(){
    	return $this->belongsTo(card::class, 'cards');
    }

    public function user(){
    	return $this->belongsTo(user::class);
    }
     
}
