<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// ログイン情報取得に必要
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    // 入力画面へ遷移
    public function user()
    {
        return view('user');
    }

    // 入力データ書き込み
    public function user_change(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'required',
        ]);

        $id = Auth::id();
        $name_base = Auth::user()->name;
        $email_base = Auth::user()->email;
        $name = $request->name;
        $email = $request->email;
        
        if($name_base != $name || $email_base != $email){
            $data = [
                'name' => $name,
                'email' => $email,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            
            User::where('id', $id)->update($data);
            session()->flash('msg_success', '変更しました');
            return redirect('/user');
        } else {
            session()->flash('msg_warning', 'ユーザー設定は変更されていません。');
            return redirect('/user');
        }
    }
}
