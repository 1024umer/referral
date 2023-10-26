<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SurveyRequest;
use App\Http\Resources\Api\SurveyResource;
use App\Repositories\ListRepository;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    protected $listRep;
    public function __construct(ListRepository $listRep)
    {
        $this->listRep = $listRep;
        $this->listRep->bindModel(Survey::class);
    }
    public function index()
    {
        $query = $this->listRep->listFilteredQuery(['name'])
            ->select('surveys.*');
        if (isset($_GET['is_active']) && intval($_GET['is_active']) > 0) {
            $query = $query->where('is_active', $_GET['is_active']);
        }
        if (isset($_GET['perpage']) && intval($_GET['perpage']) > 0) {
            $query = $query->paginate($_GET['perpage']);
        } else {
            $query = $query->get();
        }
        return SurveyResource::collection($query);
    }
    public function store(SurveyRequest $request)
    {
        $id = bcrypt($request->name . $request->id);
        $surveys = Survey::create([
            'name' => $request->name,
            'survey_id' => bcrypt($id),
            'is_active' => $request->is_active,
        ]);
        return new SurveyResource($surveys);
    }
    public function show(Survey $surveys, $id)
    {
        $surveys = Survey::where('id', $id)->first();
        return new SurveyResource($surveys);
    }
    public function update(SurveyRequest $request, $id)
    {
        $surveys = Survey::find($id);
        if ($surveys->name !== $request->name) {
            $surveys->survey_id = bcrypt($request->name . $surveys->id);
        }
        $surveys->fill($request->only('name', 'is_active'));
        $surveys->save();
        return new SurveyResource($surveys);
    }
    public function destroy($id)
    {
        $surveys = Survey::find($id)->delete();
        return response()->json(null, 204);
    }
}