<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User};

class IndexController extends Controller
{
    public function index()
    {
        $user = User::where('id',auth()->user()->id)->with('image')->first();
        $query='/?_agent_id=insurance&utm_source=';
        if($user->referral_id != null){
            $parent = User::where('id',$user->referral_id)->first();
            $link = env('APP_URL'). $query .'/'.$user->first_name . '/'.$user->id ;
            return view('dashboard.index')->with('title', 'Home')->with(compact('user','link','parent'));
        }
        $link = env('APP_URL'). $query .'/'.$user->first_name . '/'.$user->id ;
        return view('dashboard.index')->with('title', 'Home')->with(compact('user','link'));
    }
}