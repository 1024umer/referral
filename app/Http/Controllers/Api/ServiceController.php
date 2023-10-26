<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\ServiceRequest;
use App\Repositories\{ ListRepository,FileRepository };
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\Api\ServiceResource;
use App\Models\Service;
class ServiceController extends Controller
{
    protected $listRep;
    protected $file;
    public function __construct(ListRepository $listRep, FileRepository $file)
    {
        $this->listRep = $listRep;
        $this->file = $file;
        $this->listRep->bindModel(Service::class);
    }
    public function index()
    {
        $query = $this->listRep->listFilteredQuery(['title', 'description'])
        ->select('services.*')
        ->with('image');
        if(isset($_GET['is_active'])&&intval($_GET['is_active'])>0){
            $query=$query->where('is_active', $_GET['is_active']);
        }
        if(isset($_GET['perpage'])&&intval($_GET['perpage'])>0){
            $query=$query->paginate($_GET['perpage']);
        }else{
            $query=$query->get();
        }
        return ServiceResource::collection($query);
    }
    public function store(ServiceRequest $request)
    {
        $attributes = $request->only('title','description','is_active','is_featured','long_description','slug');
        $services = Service::create($attributes);
        if($request->image){
            $images = $this->file->create([$request->image],'services', $services->id);
        }
        $services->save();
        return new ServiceResource($services);
    }
    public function show(Service $services,$id)
    {
        $services = Service::where('id', $id)->orderBy('id','desc')->with('image')->first();
        return new ServiceResource($services);
    }
    public function update(ServiceRequest $request,$id)
    {
        $services = Service::find($id);
        $services->update($request->only('title','description','is_active','is_featured','long_description','slug'));
        if($request->image){
            $images = $this->file->create([$request->image],'services', $services->id,1);
        }
        return new ServiceResource($services);
    }
    public function destroy($id)
    {
        $services = Service::find($id)->delete();
        return response()->json(null, 204);
    }
}
