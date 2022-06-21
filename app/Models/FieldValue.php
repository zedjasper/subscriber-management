<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldValue extends Model
{
    use HasFactory;

    public function field(){
        return $this->belongsTo('App\Models\Field');
    }
    
    public function subscriber(){
        return $this->belongsTo('App\Models\Subscriber');
    }
}
