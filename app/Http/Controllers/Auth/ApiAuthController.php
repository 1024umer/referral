<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\Api\UserResource;
use App\Http\Requests\Api\ProfileRequest;
use App\Repositories\{FileRepository};

class ApiAuthController extends Controller
{
    protected $file;
    public function __construct(FileRepository $file)
    {
        $this->file = $file;
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user && $user->role_id == 1) {
            if (Hash::check($request->password, $user->password) ) {
                $token = $user->createToken('yatiflix Token Grant')->plainTextToken;
                $response = ['token' => $token, 'user' => $user];
                return response($response, 200);
            }
            $response = ["message" => "Password doesn't match"];
            return response($response, 422);
        } else {
            $response = ["message" => 'User does not exist'];
            return response($response, 422);
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    public function updateprofile(ProfileRequest $request){
        $arr = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if (isset($request->password)) {
            if (strlen($request->password) < 60) {
                $arr['password'] = Hash::make($request->password);
            }
        }
        $data = User::where('id', $request->user()->id)->update($arr);
        if($request->file){
            $this->file->create([$request->file], 'users', $request->user()->id, 1);
        }
        return new UserResource(User::find($request->user()->id));
    }
    public function ckeditorFileUpload(Request $request){
        if($request->upload){
            $file = $this->file->create([$request->upload], 'ckeditorfiles', $request->user()->id, 2);
            return response()->json(['url' => $file[0]->full_url]);
        }
    }
}