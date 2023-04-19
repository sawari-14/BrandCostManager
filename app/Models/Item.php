<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{   
    //テーブル名
    protected $table = 'items';
    //可変項目
    protected $fillable =
    [
        'name',
        'user_id',
        'price',
        'image'
    ];
    use HasFactory;
}
