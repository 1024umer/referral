<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CaseCategoryRequest;
use App\Repositories\{ ListRepository };
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\Api\CaseCategoryResource;
use App\Models\CaseCategory;
class CaseCategoryController extends Controller
{
    protected $listRep;
    public function __construct(ListRepository $listRep)
    {
        $this->listRep = $listRep;
        $this->listRep->bindModel(CaseCategory::class);
    }
    public function index()
    {
        $query = $this->listRep->listFilteredQuery(['name', 'slug'])
        ->select('case_categories.*');
        if(isset($_GET['is_active'])&&intval($_GET['is_active'])>0){
            $query=$query->where('is_active', $_GET['is_active']);
        }
        if(isset($_GET['parent_id'])&&intval($_GET['parent_id'])>0){
            $query=$query->where('parent_id', $_GET['parent_id']);
        }
        if(isset($_GET['perpage'])&&intval($_GET['perpage'])>0){
            $query=$query->paginate($_GET['perpage']);
        }else{
            $query=$query->get();
        }
        return CaseCategoryResource::collection($query);
    }

    public function store(CaseCategoryRequest $request)
    {
        $caseCategory = CaseCategory::create($request->only('name','slug', 'parent_id','is_active'));
        $caseCategory->save();
        return new CaseCategoryResource($caseCategory);
    }

  
    public function show($id)
    {
        $caseCategory = CaseCategory::where('id',$id)->first();
        return new CaseCategoryResource($caseCategory);
    }

   
    public function update(CaseCategoryRequest $request, CaseCategory $caseCategory)
    {
        // Gate::authorize('update',$caseCategory);
        $caseCategory->update($request->only('name','slug', 'parent_id','is_active'));
        return new CaseCategoryResource($caseCategory);
    }

  
    public function destroy($id)
    {
        $caseCategory= CaseCategory::find($id)->delete();
        return response()->json(null, 204);
    }
}
