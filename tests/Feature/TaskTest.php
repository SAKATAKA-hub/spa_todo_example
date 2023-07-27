<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
/*
==========================================
 タスク　テスト
==========================================
*/
class TaskTest extends TestCase
{
    use RefreshDatabase;



    /** @test */
    public function 一覧を取得することができる()
    {
        $data_count = 10;

        // DBにデータを挿入
        $tasks = Task::factory()->count( $data_count )->create();

        // タスクデータをAPIから取得
        $response = $this->getJson('api/task');

        // レスポンスのテスト
        $response
            -> assertOk() //200を返す
            -> assertJsonCount( $data_count ) //データがdata_count個あるか
        ;
    }




    /** @test */
    public function 登録することができる()
    {
        // 登録データ
        $data = ['title'=>'テスト投稿'];

        // APIからタスクデータの登録
        $response = $this->postJson('api/task', $data);

        // レスポンスのテスト
        $response
            ->assertCreated() //201を返す
            ->assertJsonFragment( $data )
        ;
    }




    /** @test */
    public function 更新することができる()
    {
        // 更新前データ
        $task = Task::factory()->create();

        // 更新データ
        $data = ['title'=>'更新テスト投稿'];

        // APIからタスクデータの更新
        $response = $this->patchJson('api/task/'.$task->id, $data);

        // レスポンスのテスト
        $response
            -> assertOk() //200を返す
            ->assertJsonFragment( $data )
        ;
    }




    /** @test */
    public function 削除することができる()
    {
        $data_count = 10;

        // DBにデータを挿入
        $tasks = Task::factory()->count( $data_count )->create();
        $task  = $tasks[0];

        // APIからタスクデータを削除・レスポンステスト
        $response = $this->deleteJson('api/task/'.$task->id);
        $response->assertOk();

        // データが一つ減っていることの確認
        $response = $this->getJson('api/task');
        $response->assertJsonCount( $data_count -1 );
    }




    /** @test */
    public function タイトルが空の場合は登録できない()
    {
        // 登録データ
        $data = ['title'=>''];

        // APIからタスクデータの登録
        $response = $this->postJson('api/task', $data);
        // $response->dump();

        // レスポンスのテスト
        $response
            ->assertStatus( 422 ) //バリデーションエラー422
            ->assertJsonValidationErrors([
                'title' => 'タイトルは必須項目です。'
            ])
        ;
    }



    /** @test */
    public function タイトルが140文字を超える場合は、登録できない()
    {
        // 登録データ
        $data = ['title'=> str_repeat('あ',141)];

        // APIからタスクデータの登録
        $response = $this->postJson('api/task', $data);
        // $response->dump();

        // レスポンスのテスト
        $response
            ->assertStatus( 422 ) //バリデーションエラー422
            ->assertJsonValidationErrors([
                'title' => 'タイトルの文字数は、140文字以下である必要があります。'
            ])
        ;
    }
}
