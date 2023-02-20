<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    use HasFactory;

    public $fillable = [
        "name",
        "description",
        "img",
        "phone",
        "city",
        "address",
        "type",
        "user_id"
    ];
    
    public function city(){
        return $this->hasOne(City::class, 'city');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}
