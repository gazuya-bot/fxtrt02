<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Input;
// ログイン情報取得に必要
use Illuminate\Support\Facades\Auth;

class OutputController extends Controller
{
    //
    public function output()
    {
        $user_id = Auth::id();
        $input_data = Input::where('active',1)->where('user_id', $user_id)->orderby('id','desc')->paginate(20);
        return view('output', compact('input_data'));
    }

    // 投稿削除
    public function delete($id)
    {
        Input::where('id', $id)->update(['active'=>0, 'updated_at'=>now()]);
        return redirect('/output');
    }

    // 投稿内容編集画面
    public function change($id)
    {
        $user_id = Auth::id();
        // $change_data = Input::where('user_id', $user_id)->where('id', $id)->get();
        $change_data = Input::where('user_id', $user_id)->find($id);
        return view('output_change', compact('change_data'));
    }

    // 変更データ書き込み
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
            'remarks_funda' => 'max:1000|nullable',
            'img_01' => 'file|mimes:jpeg,png,jpg|nullable',
            'img_02' => 'file|mimes:jpeg,png,jpg|nullable',
        ]);

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
        $remarks_funda = $request->remarks_funda;
        $img_01 = $request->img_01;
        $img_02 = $request->img_02;

        
        // if($name_base != $name || $email_base != $email){
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
                'remarks_funda' => $remarks_funda,
                'img_01' => $img_01,
                'img_02' => $img_02,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            
            Input::where('id', $id)->update($data);
            session()->flash('msg_success', '変更しました');
            return redirect('/output');
        // } else {
        //     session()->flash('msg_warning', '入力情報は変更されていません。');
        //     return redirect('/user');
        // }
    }
}
