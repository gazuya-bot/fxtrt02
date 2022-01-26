<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
// ログイン情報取得に必要
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    //
    // 入力画面へ遷移
    public function currency()
    {
        $user_id = Auth::id();
        $currency_act = Currency::where('active',1)->where('user_id', $user_id)->orderby('currency','asc')->get();
        $currency_del = Currency::where('active',0)->where('user_id', $user_id)->orderby('currency','asc')->get();
        return view('currency', compact('currency_act','currency_del'));
    }

    // 通貨非表示
    public function delete($id)
    {
        Currency::where('id', $id)->update(['active'=>0, 'updated_at'=>now()]);
        return redirect('/currency');
    }

    // 通貨表示
    public function active($id)
    {
        Currency::where('id', $id)->update(['active'=>1, 'updated_at'=>now()]);
        return redirect('/currency');
    }

    // 入力データ書き込み
    public function currency_change(Request $request)
    {
        // バリデーション
        $request->validate([
            'currency_pair' => 'required|max:10|unique:currencies,currency',
        ]);

        $user_id = Auth::id();
        $currency_pair = $request->currency_pair;
        $btn_submit_01 = $request->btn_submit_01;

        if($currency_pair != null){
            $data = [
                'active' => 1,
                'user_id' => $user_id,
                'currency' => $currency_pair,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            
            if(isset($btn_submit_01)){
                Currency::insert($data);
                session()->flash('msg_success', '追加しました');
                return redirect('/currency');
            }else{
                Currency::where('currency', $currency_pair)->delete();
                session()->flash('msg_warning', '削除しました');
                return redirect('/currency');
            }

        } else {
            session()->flash('msg_warning', 'この通貨ペアは既に登録されています。');
            return redirect('/currency');
        }
    }

}