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
        "type"
    ];
    public function city(){
        return $this->hasOne(City::class);
}
}
