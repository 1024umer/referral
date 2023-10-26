<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\FeedbackRequest;
use App\Repositories\ListRepository ;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\Api\FeedbackResource;
use App\Models\Feedback;
class FeedbackController extends Controller
{
    protected $listRep;
    public function __construct(ListRepository $listRep)
    {
        $this->listRep = $listRep;
        $this->listRep->bindModel(Feedback::class);
    }
    public function index()
    {
        $query = $this->listRep->listFilteredQuery(['feedback','is_active'])
        ->select('feedback.*');
        if(isset($_GET['is_active'])&&intval($_GET['is_active'])>0){
            $query=$query->where('is_active', $_GET['is_active']);
        }
        if(isset($_GET['perpage'])&&intval($_GET['perpage'])>0){
            $query=$query->paginate($_GET['perpage']);
        }else{
            $query=$query->get();
        }
        return FeedbackResource::collection($query);
    }
    public function store(FeedbackRequest $request)
    {
        $attributes = $request->only('feedback','is_active');
        $feedbacks = Feedback::create($attributes);
        $feedbacks->save();
        return new FeedbackResource($feedbacks);
    }
    public function show(Feedback $feedbacks,$id)
    {
        $feedbacks = Feedback::where('id', $id)->first();
        return new FeedbackResource($feedbacks);
    }
    public function update(FeedbackRequest $request,$id)
    {
        $feedbacks = Feedback::find($id);
        $feedbacks->update($request->only('feedback','is_active'));
        return new FeedbackResource($feedbacks);
    }
    public function destroy($id)
    {
        $feedbacks = Feedback::find($id)->delete();
        return response()->json(null, 204);
    }
}
