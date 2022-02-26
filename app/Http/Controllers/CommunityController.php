<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Input;
// ログイン情報取得に必要
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    //
    public function community()
    {
        $user_id = Auth::id();

        // $input_data = Input::where('active',1)->where('user_id', $user_id)->orderby('id','desc')->where(function ($query) {
        $input_data = Input::where('active',1)->orderby('id','desc')->where(function ($query) {
        
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

        return view('community', compact('input_data'));
    }
}
