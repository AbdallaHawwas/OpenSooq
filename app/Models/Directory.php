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
        "user_id",
        "category_id",
        "city_id",
        "lang"
    ];
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}
