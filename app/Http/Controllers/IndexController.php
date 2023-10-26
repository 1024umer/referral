<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User};

class IndexController extends Controller
{
    public function index()
    {
        $user = User::where('id',auth()->user()->id)->first();
        return view('dashboard.index')->with('title', 'Home')->with(compact('user'));
    }
}