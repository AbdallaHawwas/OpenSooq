<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpCenter extends Model
{
    use HasFactory;

    public $fillable = [
        'vid_category',
        'link',
        'title',
        'subtitle',
    ];
    
}
