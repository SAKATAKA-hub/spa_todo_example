<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/*
==========================================
 タスク　バリデーションリクエスト
==========================================
*/
class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() { return true; }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'title' => ['required','max:140',]//''
        ];
    }


    /**
     * パラメーターの日本語表記
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => 'タイトル',
        ];
    }
}
