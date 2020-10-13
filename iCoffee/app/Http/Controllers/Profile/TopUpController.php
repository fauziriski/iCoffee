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
        $top_up = Top_up::where('user_id', $user_id)->orderBy('created_at','desc')->paginate(1);
        $balance_withdrawal = Balance_withdrawal::where('user_id', $user_id)->orderBy('created_at','desc')->paginate(1);

        foreach ($balance_withdrawal as $key => $value) {
            $allsaldo[] = $value;
        }

     
        foreach ($allsaldo as $key => $value) {
           if ($allsaldo[$key]->bank) {
               $allsaldo[$key]->title = "balance_withdrawal";
           }
           else {
               $allsaldo[$key]->title = "top_up";
           }
        }

        for ($i = 0;$i < count($allsaldo);$i++){
            $k = $i;
            for ($j = $i+1;$j<count($allsaldo);$j++){
              if ($allsaldo[$j]->created_at > $allsaldo[$k]->created_at) {
                  $k = $j;
                }
            }   
            $dummy=$allsaldo[$i];
            $allsaldo[$i]=$allsaldo[$k];
            $allsaldo[$k]=$dummy;
          }
          return view('jual-beli.topup.index', compact('allsaldo', 'top_up', 'balance_withdrawal'));
    }
}
