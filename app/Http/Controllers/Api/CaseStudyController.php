<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CaseStudyRequest;
use App\Repositories\{ ListRepository,FileRepository };
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\Api\CaseStudyResource;
use App\Models\CaseStudy;
class CaseStudyController extends Controller
{
    protected $listRep;
    protected $file;
    public function __construct(ListRepository $listRep, FileRepository $file)
    {
        $this->listRep = $listRep;
        $this->file = $file;
        $this->listRep->bindModel(CaseStudy::class);
    }
    public function index()
    {
        $query = $this->listRep->listFilteredQuery(['title', 'category'])
        ->select('case_studies.*')
        ->with('category','image');
        if(isset($_GET['is_active'])&&intval($_GET['is_active'])>0){
            $query=$query->where('is_active', $_GET['is_active']);
        }
        if(isset($_GET['category_id'])&&intval($_GET['category_id'])>0){
            $query=$query->where('category_id', $_GET['category_id']);
        }
        if(isset($_GET['perpage'])&&intval($_GET['perpage'])>0){
            $query=$query->paginate($_GET['perpage']);
        }else{
            $query=$query->get();
        }
        return CaseStudyResource::collection($query);
    }
    public function store(CaseStudyRequest $request)
    {
        $attributes = $request->only( 'title','description','is_active','long_description','slug','case_categories_ids');
        $caseStudys = CaseStudy::create($attributes);
        if($request->image){
            $images = $this->file->create([$request->image],'case_studies', $caseStudys->id);
        }
        $caseStudys->save();
        return new CaseStudyResource($caseStudys);
    }
    public function show(CaseStudy $caseStudys,$id)
    {
        $caseStudys = CaseStudy::where('id', $id)->first();
        return new CaseStudyResource($caseStudys);
    }
    public function update(CaseStudyRequest $request,$id)
    {
        $caseStudys = CaseStudy::find($id);
        $caseStudys->update($request->only( 'title','description','is_active','long_description','slug','case_categories_ids'));
        if($request->image){
            $images = $this->file->create([$request->image],'case_studies', $caseStudys->id,1);
        }
        return new CaseStudyResource($caseStudys);
    }
    public function destroy($id)
    {
        $caseStudys = CaseStudy::find($id)->delete();
        return response()->json(null, 204);
    }
}
