<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{   
    //テーブル名
    protected $table = 'costs';
    //可変項目
    protected $fillable =
    [
        'user_id',
        'item_id',
        'price',
        'date',
        'content',
        'count'
    ];
    use HasFactory;
}
