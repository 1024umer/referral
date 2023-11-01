<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User};

class IndexController extends Controller
{
    public function index()
    {
        $referrals = User::where('referral_id',auth()->user()->id)->get();
        $user = User::where('id',auth()->user()->id)->with('image')->first();
        $query='/?_agent_id=insurance&utm_source=';
        if($user->state == 'Florida' || $user->state == 'Texas' || $user->state == 'Illinios'){
            $link2 =  env('APP_URL'). '/?_agent_id=insurace' .'/' ;
        }else{
            $link2 =  env('APP_URL'). '/?_agent_id=Wecare' .'/' ;
        }
        if($user->referral_id != null){
            $parent = User::where('id',$user->referral_id)->first();
            $link = env('APP_URL').'/'.$user->first_name . '/'.$user->id ;
            return view('dashboard.index')->with('title', 'Home')->with(compact('user','link','link2','parent','referrals'));
        }
        $link = env('APP_URL').'/'.$user->first_name . '/'.$user->id ;
        
        return view('dashboard.index')->with('title', 'Home')->with(compact('user','link','link2','referrals'));
    }
}