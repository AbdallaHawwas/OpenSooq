<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voucher extends Model
{
    use HasFactory;

    public $fillable =[
        "code",
        "name",
        'amount',
        "special_user",
        "include_shipping",
        "starts_from",
        "ends_at"
    ];
    
    public function user(){
        $this->belongsTo(User::class);
    } 
}
