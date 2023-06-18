<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
/*
 | ===================================
 |  タスク　ファクトリー
 | ===================================
 */
class TaskFactory extends Factory
{
    /**
     * モデルと対応するファクトリの名前
     * @var string
     */
    protected $model = \App\Models\Task::class;

    /**
     * モデルのデフォルト状態の定義
     *
     * @return array
     */
    public function definition()
    {
        return [
            //タイトル
            'title' => $this->faker->realText( rand(15,40) ),
            //対応済みか否か
            'is_done' => $this->faker->boolean(10),// 1/10の確率でtrue
        ];
    }
}
