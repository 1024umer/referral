<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    protected $file;
    public function __construct(FileRepository $file){
        $this->file = $file;
    }
    public function index(){
        return view('dashboard.auth.login')->with('title','Login');
    }
    public function register(RegisterRequest $request){
        $user = User::create([
            'first_name'=> $request->first_name,
            'last_name' => $request->last_name,
            'email'=> $request->email,
            'password'=>Hash::make($request->password),
            'state'=> $request->state,
            'dob'=> $request->dob,
            'role_id'=>2,
        ]);
        if($request->profile_image){
            $image = $this->file->create([$request->profile_image],'users', $user->id);
        }
        return back()->with('success','Your Account has been created please login!');
    }
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $credentials['role_id'] = 2;
        if (Auth::attempt($credentials,true)) {
            $request->session()->regenerate();
            $request->session()->flash('success', 'Logged In successfully!');
            return redirect()->route('user.dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
