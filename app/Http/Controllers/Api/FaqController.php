<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\FaqRequest;
use App\Repositories\ListRepository ;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\Api\FaqResource;
use App\Models\Faq;
class FaqController extends Controller
{
    protected $listRep;
    public function __construct(ListRepository $listRep)
    {
        $this->listRep = $listRep;
        $this->listRep->bindModel(Faq::class);
    }
    
    public function index()
    {
        $query = $this->listRep->listFilteredQuery(['question','answer','title','is_active'])
        ->select('faqs.*');
        if(isset($_GET['is_active'])&&intval($_GET['is_active'])>0){
            $query=$query->where('is_active', $_GET['is_active']);
        }
        if(isset($_GET['perpage'])&&intval($_GET['perpage'])>0){
            $query=$query->paginate($_GET['perpage']);
        }else{
            $query=$query->get();
        }
        return FaqResource::collection($query);
    }
    public function store(FaqRequest $request)
    {
        $attributes = $request->only('question','answer','title','is_active');
        $faqs = Faq::create($attributes);
        $faqs->save();
        return new FaqResource($faqs);
    }
    public function show(Faq $faqs,$id)
    {
        $faqs = Faq::where('id', $id)->first();
        return new FaqResource($faqs);
    }
    public function update(FaqRequest $request, $id)
    {
        $faqs = Faq::find($id);
        $faqs->update($request->only('question','answer','title','is_active'));
        return new FaqResource($faqs);
    }
    public function destroy($id)
    {
        $faqs = Faq::find($id)->delete();
        return response()->json(null, 204);
    }
}
