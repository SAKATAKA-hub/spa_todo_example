<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
 | ===================================
 |  タスク　Model
 | ===================================
 */
class Task extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        //タイトル
        'comment' ,
        //対応済みか否か
        'is_done',
    ];


    /**
     * モデルの新ファクトリ・インスタンスの生成
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Database\Factories\TaskFactory::new();
    }
}
