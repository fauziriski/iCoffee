<?php

namespace App\Http\Controllers\Profile;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Balance_withdrawal;
use App\Top_up;
use App\User;
use DB;

class TopUpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $top_up = Top_up::where('user_id', $user_id)->orderBy('created_at','desc')->get();
        $balance_withdrawal = Balance_withdrawal::where('user_id', $user_id)->orderBy('created_at','desc')->get();

        foreach ($balance_withdrawal as $key => $value) {
            $top_up[] = $value;
        }

     
        foreach ($top_up as $key => $value) {
           if ($top_up[$key]->bank) {
               $top_up[$key]->title = "balance_withdrawal";
           }
           else {
               $top_up[$key]->title = "top_up";
           }
        }

        for ($i = 0;$i < count($top_up);$i++){
            $k = $i;
            for ($j = $i+1;$j<count($top_up);$j++){
              if ($top_up[$j]->created_at > $top_up[$k]->created_at) {
                  $k = $j;
                }
            }   
            $dummy=$top_up[$i];
            $top_up[$i]=$top_up[$k];
            $top_up[$k]=$dummy;
          }
          return view('jual-beli.topup.index', compact('top_up'));
    }
}
