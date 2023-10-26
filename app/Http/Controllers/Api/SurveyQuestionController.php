<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\SurveyQuestionRequest;
use App\Http\Resources\Api\SurveyQuestionResource;
use App\Models\SurveyQuestion;
use App\Repositories\ListRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SurveyQuestionController extends Controller
{
    protected $listRep;
    public function __construct(ListRepository $listRep)
    {
        $this->listRep = $listRep;
        $this->listRep->bindModel(SurveyQuestion::class);
    }
    public function index()
    {
        $query = $this->listRep->listFilteredQuery(['question'])
            ->select('survey_questions.*')->with('survey');
        if (isset($_GET['is_active']) && intval($_GET['is_active']) > 0) {
            $query = $query->where('is_active', $_GET['is_active']);
        }
        if (isset($_GET['perpage']) && intval($_GET['perpage']) > 0) {
            $query = $query->paginate($_GET['perpage']);
        } else {
            $query = $query->get();
        }
        return SurveyQuestionResource::collection($query);
    }
    public function store(SurveyQuestionRequest $request)
    {
        $surveys = SurveyQuestion::create([
            'question' => $request->question,
            'survey_id' => $request->survey_id,
            'sortOrder' => 1,
        ]);
        return new SurveyQuestionResource($surveys);
    }
    public function show($id)
    {
        $surveys = SurveyQuestion::where('id', $id)->first();
        return new SurveyQuestionResource($surveys);
    }
    public function update(SurveyQuestionRequest $request, $id)
    {
        $surveys = SurveyQuestion::find($id);
        $surveys->update($request->only('survey_id', 'question'));
        $surveys->save();
        return new SurveyQuestionResource($surveys);
    }
    public function destroy($id)
    {
        $surveys = SurveyQuestion::find($id)->delete();
        return response()->json(null, 204);
    }
}