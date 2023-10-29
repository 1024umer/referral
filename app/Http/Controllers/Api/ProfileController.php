<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\FileRepository;
use App\Models\User;
use App\Http\Resources\Api\ProfileResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    protected $file;
    public function __construct(FileRepository $file){
        $this->file =  $file;
    }
    public function index()
    {
        $user = User::where('id',auth()->user()->id)->first();
        return new ProfileResource($user);
    }
    
    public function show()
    {
        $id = auth()->user()->id;
        $user  = User::where('id',$id)->orderBy('id','desc')->with('image','signature')->first();
        return new ProfileResource($user);
    }
    public function update(Request $request)
    {
        $user = $request->user();
        $attributes = $request->only('name');
        if($request->email){
            $validator= Validator::make($request->all(),[
                'email'=> 'email|unique:App\Models\User,email'
            ]);
        }
        $attributes['email'] = $request->email;
        if($request->password&&$request->password!=''){
            $attributes['password'] = Hash::make($request->password);
        }
        $user->update($attributes);
        if($request->image){
            $this->file->create([$request->image], 'users', $request->user()->id, 1);
        }
        return new ProfileResource($user);
    }
   
}
