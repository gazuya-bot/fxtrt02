<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Input;
// ログイン情報取得に必要
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id(); // ユーザーID
        $today = date('Y-m-d'); //当日
        $d_ago = date('Y-m-d', strtotime('-1 day')); //前日
        $w_ago = date('Y-m-d', strtotime('-7 day')); //1週間前 ~ 前日
        $m_ago = date('Y-m-d', strtotime('-30 day')); //1カ月前 ~ 前日 ✖

        // echo $d_ago;
        // echo $w_ago;
        // echo $m_ago;
        // exit;

        // 前日のトレード件数
        $d_count = Input::where('active',1)
            ->whereDate('start_day', $d_ago)
            ->where('user_id', $id)
            ->count();

        // 週間のトレード件数
        $w_count = Input::where('active',1)
            ->whereBetween('start_day', [$w_ago, $today])
            ->where('user_id', $id)
            ->count();

        // 月間のトレード件数
        $m_count = Input::where('active',1)
            ->whereBetween('start_day', [$m_ago, $today])
            ->where('user_id', $id)
            ->count();

        // 前日の勝率
        $d_win = Input::where('active',1)
            ->where('win_lose',1)
            ->whereDate('start_day', $d_ago)
            ->where('user_id', $id)
            ->count();

        if($d_win > 0){
            $d_win_rate = ($d_win / $d_count)*100;
        }else{
            $d_win_rate = 0;
        }

        // 週間の勝率
        $w_win = Input::where('active',1)
            ->where('win_lose',1)
            ->whereBetween('start_day', [$w_ago, $today])
            ->where('user_id', $id)
            ->count();

        if ($w_win > 0){
            $w_win_rate = ($w_win / $w_count)*100;
        }else{
            $w_win_rate = 0;
        }

        // 月間の勝率
        $m_win = Input::where('active',1)
            ->where('win_lose',1)
            ->whereBetween('start_day', [$m_ago, $today])
            ->where('user_id', $id)
            ->count();
        
        if($m_win > 0){
            $m_win_rate = ($m_win / $m_count)*100;
        }else{
            $m_win_rate = 0;
        }

        // 前日の利益(pips)
        $d_pips = Input::where('active',1)
            ->whereDate('start_day', $d_ago)
            ->where('user_id', $id)
            ->sum('profit_pips');

        // 前日の利益(円)
        $d_yen = Input::where('active',1)
            ->whereDate('start_day', $d_ago)
            ->where('user_id', $id)
            ->sum('profit_yen');

        // 週間の利益(pips)
        $w_pips = Input::where('active',1)
            ->whereBetween('start_day', [$w_ago, $today])
            ->where('user_id', $id)
            ->sum('profit_pips');

        // 週間の利益(円)
        $w_yen = Input::where('active',1)
            ->whereBetween('start_day', [$w_ago, $today])
            ->where('user_id', $id)
            ->sum('profit_yen');

        // 月間の利益(pips)
        $m_pips = Input::where('active',1)
            ->whereBetween('start_day', [$m_ago, $today])
            ->where('user_id', $id)
            ->sum('profit_pips');
            
        // 月間の利益(円)
        $m_yen = Input::where('active',1)
            ->whereBetween('start_day', [$m_ago, $today])
            ->where('user_id', $id)
            ->sum('profit_yen');
        
        return view('home', compact('d_count','w_count','m_count','d_win_rate','w_win_rate','m_win_rate','d_pips','w_pips','m_pips','d_yen','w_yen','m_yen'));
    }

}
