<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SurveyQuestionAnswerRequest;
use App\Http\Resources\Api\SurveyQuestionAnswerResource;
use App\Models\SurveyQuestionAnswer;
use App\Repositories\ListRepository;
use Illuminate\Http\Request;

class SurveyQuestionAnswerController extends Controller
{
    protected $listRep;
    public function __construct(ListRepository $listRep)
    {
        $this->listRep = $listRep;
        $this->listRep->bindModel(SurveyQuestionAnswer::class);
    }
    public function index()
    {
        $query = $this->listRep->listFilteredQuery(['survey_question_id', 'answer', 'survey_id'])
            ->select('survey_question_answers.*');
        if (isset($_GET['is_active']) && intval($_GET['is_active']) > 0) {
            $query = $query->where('is_active', $_GET['is_active']);
        }
        if (isset($_GET['perpage']) && intval($_GET['perpage']) > 0) {
            $query = $query->paginate($_GET['perpage']);
        } else {
            $query = $query->get();
        }
        return SurveyQuestionAnswerResource::collection($query);
    }
    public function store(SurveyQuestionAnswerRequest $request)
    {
        $surveys = SurveyQuestionAnswer::create([
            'answer' => $request->answer,
            'survey_id' => $request->survey_id,
            'survey_question_id' => $request->survey_question_id,
            'is_correct' => $request->is_correct,
        ]);
        return new SurveyQuestionAnswerResource($surveys);
    }
    public function show($id)
    {
        $surveys = SurveyQuestionAnswer::where('id', $id)->first();
        return new SurveyQuestionAnswerResource($surveys);
    }
    public function update(SurveyQuestionAnswerRequest $request, $id)
    {
        $surveys = SurveyQuestionAnswer::where('id', $id)->first();
        $surveys->update($request->only('survey_id', 'survey_question_id', 'answer', 'is_correct'));
        $surveys->save();
        return new SurveyQuestionAnswerResource($surveys);
    }
    public function destroy($id)
    {
        $surveys = SurveyQuestionAnswer::find($id)->delete();
        return response()->json(null, 204);
    }
}