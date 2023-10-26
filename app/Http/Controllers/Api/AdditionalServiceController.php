<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AdditionalServiceRequest;
use App\Repositories\{ ListRepository,FileRepository };
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\Api\AdditionalServiceResource;
use App\Models\AdditionalService;
class AdditionalServiceController extends Controller
{
    protected $listRep;
    protected $file;
    public function __construct(ListRepository $listRep, FileRepository $file)
    {
        $this->listRep = $listRep;
        $this->file = $file;
        $this->listRep->bindModel(AdditionalService::class);
    }
    public function index()
    {
        $query = $this->listRep->listFilteredQuery(['title', 'description'])
        ->select('additional_services.*')
        ->with('image');
        if(isset($_GET['is_active'])&&intval($_GET['is_active'])>0){
            $query=$query->where('is_active', $_GET['is_active']);
        }
        if(isset($_GET['perpage'])&&intval($_GET['perpage'])>0){
            $query=$query->paginate($_GET['perpage']);
        }else{
            $query=$query->get();
        }
        return AdditionalServiceResource::collection($query);
    }
    public function store(AdditionalServiceRequest $request)
    {
        $attributes = $request->only('title','description','is_active');
        $additionalServices = AdditionalService::create($attributes);
        if($request->image){
            $images = $this->file->create([$request->image],'additional_services', $additionalServices->id);
        }
        $additionalServices->save();
        return new AdditionalServiceResource($additionalServices);
    }
    public function show(AdditionalService $additionalServices,$id)
    {
        $additionalServices = AdditionalService::where('id', $id)->with('image')->first();
        return new AdditionalServiceResource($additionalServices);
    }
    public function update(AdditionalServiceRequest $request, AdditionalService $additionalServices)
    {
        $additionalServices->find($request->id)->update($request->only('title','description','is_active'));
        if($request->image){
            $images = $this->file->create([$request->image],'additional_services', $additionalServices->id,1);
        }
        return new AdditionalServiceResource($additionalServices);
    }
    public function destroy(AdditionalService $additionalServices,$id)
    {
        $additionalServices->find($id)->delete();
        return response()->json(null, 204);
    }
}
