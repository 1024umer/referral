<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\{ ListRepository,FileRepository };
use App\Models\User;
use App\Http\Resources\Api\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\UserRequest;
class UserController extends Controller
{
    protected $listRep;
    public function __construct(ListRepository $listRep)
    {
        $this->listRep = $listRep;
        $this->listRep->bindModel(User::class);
    }
    public function index()
    {
        // Gate::authorize('viewAny',Merchant::class);
        $query = $this->listRep->listFilteredQuery(['name', 'email'])
        ->select('users.*');
        if(isset($_GET['role_id'])){
            $query = $query->where('role_id',$_GET['role_id']);
        }
        if(isset($_GET['perpage'])&&intval($_GET['perpage'])>0){
            $query=$query->paginate($_GET['perpage']);
        }else{
            $query=$query->get();
        }
        return UserResource::collection($query);
    }
    public function store(UserRequest $request)
    {
        $attributes = $request->only('name', 'email', 'password', 'role_id');
        $attributes['password'] = Hash::make($request->password);
        $user = User::create($attributes);
        $user->save();
        return new UserResource($user);
    }
    public function show(User $user)
    {
        return new UserResource($user);
    }
    public function update(UserRequest $request, User $user)
    {
        $attributes = $request->only('name', 'email');
        if($request->password&&$request->password!=''){
            $attributes['password'] = Hash::make($request->password);
        }
        $user->update($attributes);
        return new UserResource($user);
    }
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
