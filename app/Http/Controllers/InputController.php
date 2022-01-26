<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Input;
use App\Models\Currency;
// ログイン情報取得に必要
use Illuminate\Support\Facades\Auth;

class InputController extends Controller
{
    // 入力画面へ遷移
    public function input()
    {
        $user_id = Auth::id();
        $currency_act = Currency::where('active',1)->where('user_id', $user_id)->orderby('currency','asc')->get();
        return view('input', compact('currency_act'));
    }

    // 入力データ書き込み
    public function input_add(Request $request)
    {
        if($request->has('btn_submit_01')){

            // バリデーション
            $request->validate([
                'trade_currency' => 'required',
                'trade_num' => 'required|numeric|max:10',
                'buy_sell' => 'required',
                'start_day' => 'required|date',
                'end_day' => 'required|date|after:start_day',
                'start_rate' => 'required|numeric',
                'end_rate' => 'required|numeric',
                'profit_pips' => 'required|numeric',
                'profit_yen' => 'numeric|nullable',
                'remarks_tech' => 'max:1000|nullable',
                'img_01' => 'file|mimes:jpeg,png,jpg|nullable',
                'img_02' => 'file|mimes:jpeg,png,jpg|nullable',
            ]);

            if(isset($request->img_01)){
                // name属性が'img_01'のinputタグをファイル形式に、画像をpublic/avatarに保存
                $image_path_01 = $request->file('img_01')->store('public/img_user/');
                // 保存した画像に名前を付け、DBへ格納
                $img_01 = basename($image_path_01);
            }else{
                $img_01 = null;
            }

            if(isset($request->img_02)){
                // name属性が'img_02'のinputタグをファイル形式に、画像をpublic/avatarに保存
                $image_path_02 = $request->file('img_02')->store('public/img_user/');
                // 保存した画像に名前を付け、DBへ格納
                $img_02 = basename($image_path_02);
            }else{
                $img_02 = null;
            }

            $user_id = Auth::id();
            $trade_currency = $request->trade_currency;
            $trade_num = $request->trade_num;
            $buy_sell = $request->buy_sell;
            $start_day = $request->start_day;
            $end_day = $request->end_day;
            $start_rate = $request->start_rate;
            $end_rate = $request->end_rate;
            $profit_pips = $request->profit_pips;
            $profit_yen = $request->profit_yen;
            $remarks_tech = $request->remarks_tech;

            // 勝敗
            if($profit_pips >= 0){
                $win_lose =  1;
            }else{
                $win_lose =  0;
            }

            $data = [
                'active' => 1,
                'user_id' => $user_id,
                'win_lose' => $win_lose,
                'trade_currency' => $trade_currency,
                'trade_num' => $trade_num,
                'buy_sell' => $buy_sell,
                'start_day' => $start_day,
                'end_day' => $end_day,
                'start_rate' => $start_rate,
                'end_rate' => $end_rate,
                'profit_pips' => $profit_pips,
                'profit_yen' => $profit_yen,
                'img_01' => $img_01,
                'img_02' => $img_02,
                'remarks_tech' => $remarks_tech,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            
            Input::insert($data);
            session()->flash('msg_success', '登録しました');
            return redirect('/input');
        } else {
            session()->flash('msg_warning', '入力内容を削除しました');
            return redirect('/input');
        }
    }
}