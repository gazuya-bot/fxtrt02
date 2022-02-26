<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Input;
// ログイン情報取得に必要
use Illuminate\Support\Facades\Auth;

class OutputController extends Controller
{
    //出力画面表示・検索（１つのキーワードのみ）sum ver
    public function output()
    {
        $user_id = Auth::id();

        $input_data = Input::where('active',1)->where('user_id', $user_id)->orderby('id','desc')->where(function ($query) {
        
            // 検索キーワードを置換
            $search = request('search');

            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($search, 's');

            // 単語を半角スペースで区切り、配列にキーワードを代入する（例："A B" → ["A", "B"]）
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            
            // 検索キーワードが入力されたら
            if ($search) {
                foreach($wordArraySearched as $value) {
                    $query->where('win_lose', 'LIKE', "%{$value}%")
                            ->orWhere('trade_currency','LIKE',"%{$value}%")
                            ->orWhere('buy_sell','LIKE',"%{$value}%")
                            ->orWhere('remarks_tech','LIKE',"%{$value}%");
                }
            }
        })->paginate(10);

        return view('output', compact('input_data'));
    }

    // 投稿削除
    public function delete($id)
    {
        Input::where('id', $id)->delete();
        return redirect('/output');
    }

    // 投稿編集画面
    public function change($id)
    {
        $user_id = Auth::id();
        $change_data = Input::where('user_id', $user_id)->find($id);
        return view('output_change', compact('change_data'));
    }

    // 投稿データ変更
    public function input_change(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'trade_currency' => 'required',
            'trade_num' => 'required|numeric',
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

        // 入力値取得
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
            
        // 既存の値取得
        $base = Input::where('id',$id)->get();

        $base_trade_currency = $base[0]['trade_currency'];
        $base_trade_num = $base[0]['trade_num'];
        $base_buy_sell = $base[0]['buy_sell'];
        $base_start_day = date('Y-m-d\TH:i', strtotime($base[0]['start_day']));
        $base_end_day = date('Y-m-d\TH:i', strtotime($base[0]['end_day']));
        $base_start_rate = $base[0]['start_rate'];
        $base_end_rate = $base[0]['end_rate'];
        $base_profit_pips = $base[0]['profit_pips'];
        $base_profit_yen = $base[0]['profit_yen'];
        $base_remarks_tech = $base[0]['remarks_tech'];
        $base_img_01 = $base[0]['img_01'];
        $base_img_02 = $base[0]['img_02'];

        // 変更確認
        if($base_trade_currency != $trade_currency
            || $base_trade_num != $trade_num
            || $base_buy_sell != $buy_sell
            || $base_start_day != $start_day
            || $base_end_day != $end_day 
            || $base_start_rate != $start_rate 
            || $base_end_rate != $end_rate 
            || $base_profit_pips != $profit_pips 
            || $base_profit_yen != $profit_yen
            || $base_remarks_tech != $remarks_tech
            || isset($img_01)
            || isset($img_02)
        ){

            switch(true){
                case $img_01 !== null && $img_02 == null:
                    $data = [
                        'trade_currency' => $trade_currency,
                        'trade_num' => $trade_num,
                        'buy_sell' => $buy_sell,
                        'start_day' => $start_day,
                        'end_day' => $end_day,
                        'start_rate' => $start_rate,
                        'end_rate' => $end_rate,
                        'profit_pips' => $profit_pips,
                        'profit_yen' => $profit_yen,
                        'remarks_tech' => $remarks_tech,
                        'img_01' => $img_01,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                    break;
                case $img_01 == null && $img_02 !== null:
                    $data = [
                        'trade_currency' => $trade_currency,
                        'trade_num' => $trade_num,
                        'buy_sell' => $buy_sell,
                        'start_day' => $start_day,
                        'end_day' => $end_day,
                        'start_rate' => $start_rate,
                        'end_rate' => $end_rate,
                        'profit_pips' => $profit_pips,
                        'profit_yen' => $profit_yen,
                        'remarks_tech' => $remarks_tech,
                        'img_02' => $img_02,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];    
                    break;
                case $img_01 !== null && $img_02 !== null:
                    $data = [
                        'trade_currency' => $trade_currency,
                        'trade_num' => $trade_num,
                        'buy_sell' => $buy_sell,
                        'start_day' => $start_day,
                        'end_day' => $end_day,
                        'start_rate' => $start_rate,
                        'end_rate' => $end_rate,
                        'profit_pips' => $profit_pips,
                        'profit_yen' => $profit_yen,
                        'remarks_tech' => $remarks_tech,
                        'img_01' => $img_01,
                        'img_02' => $img_02,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];    
                    break;
                case $img_01 == null && $img_02 == null:
                    $data = [
                        'trade_currency' => $trade_currency,
                        'trade_num' => $trade_num,
                        'buy_sell' => $buy_sell,
                        'start_day' => $start_day,
                        'end_day' => $end_day,
                        'start_rate' => $start_rate,
                        'end_rate' => $end_rate,
                        'profit_pips' => $profit_pips,
                        'profit_yen' => $profit_yen,
                        'remarks_tech' => $remarks_tech,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                    break;
            }
                
            Input::where('id', $id)->update($data);
            session()->flash('msg_success', '変更しました');
            return redirect('/output');

        } else {
            session()->flash('msg_warning', '入力情報は変更されていません。');
            return redirect('/output_change/' . $id);
        }
    }
}