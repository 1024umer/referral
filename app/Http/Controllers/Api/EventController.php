<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\EventRequest;
use App\Repositories\{ ListRepository,FileRepository };
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\Api\EventResource;
use App\Models\Event;
class EventController extends Controller
{
    protected $listRep;
    protected $file;
    public function __construct(ListRepository $listRep, FileRepository $file)
    {
        $this->listRep = $listRep;
        $this->file = $file;
        $this->listRep->bindModel(Event::class);
    }
    public function index()
    {
        $query = $this->listRep->listFilteredQuery(['title', 'description'])
        ->select('events.*')
        ->with('image');
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
        return EventResource::collection($query);
    }
    public function store(EventRequest $request)
    {
        $attributes = $request->only('title','description','is_active','time','date','location','is_active');
        $events = Event::create($attributes);
        if($request->image){
            $images = $this->file->create([$request->image],'events', $events->id);
        }
        $events->save();
        return new EventResource($events);
    }
    public function show(Event $events,$id)
    {
        $events = Event::where('id', $id)->orderBy('id','desc')->with('image')->first();
        return new EventResource($events);
    }
    public function update(EventRequest $request,$id)
    {
        $events = Event::find($id);
        $events->update($request->only('title','description','is_active','time','date','location','is_active'));
        if($request->image){
            $images = $this->file->create([$request->image],'Events', $events->id,1);
        }
        return new EventResource($events);
    }
    public function destroy($id)
    {
        $events = Event::find($id)->delete();
        return response()->json(null, 204);
    }
}
