<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{   
        //テーブル名
        protected $table = 'contents';
        //可変項目
        protected $fillable =
        [
            'content'
        ];
    use HasFactory;
}
