<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\{ ListRepository,FileRepository };
use App\Models\Role;
use App\Http\Resources\Api\RoleResource;
use App\Http\Requests\Api\RoleRequest;
class RoleController extends Controller
{
    protected $listRep;
    public function __construct(ListRepository $listRep)
    {
        $this->listRep = $listRep;
        $this->listRep->bindModel(Role::class);
    }
    public function index()
    {
        // Gate::authorize('viewAny',Merchant::class);
        $query = $this->listRep->listFilteredQuery(['name', 'title'])
        ->select('roles.*');
        if(isset($_GET['perpage'])&&intval($_GET['perpage'])>0){
            $query=$query->paginate($_GET['perpage']);
        }else{
            $query=$query->get();
        }
        return RoleResource::collection($query);
    }
    public function store(RoleRequest $request)
    {
        $attributes = $request->only('name', 'title');
        $role = Role::create($attributes);
        $role->save();
        return new RoleResource($role);
    }
    public function show(Role $role)
    {
        return new RoleResource($role);
    }
    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->only('name', 'title'));
        return new RoleResource($role);
    }
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(null, 204);
    }
}
