<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\ChooseUsRequest;
use App\Repositories\{ ListRepository };
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\Api\ChooseUsResource;
use App\Models\ChooseUs;
class ChooseUsController extends Controller
{
    protected $listRep;
    public function __construct(ListRepository $listRep)
    {
        $this->listRep = $listRep;
        $this->listRep->bindModel(ChooseUs::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gate::authorize('viewAny',Merchant::class);
        $query = $this->listRep->listFilteredQuery(['title', 'description'])
        ->select('choose_us.*');
        if(isset($_GET['perpage'])&&intval($_GET['perpage'])>0){
            $query=$query->paginate($_GET['perpage']);
        }else{
            $query=$query->get();
        }
        return ChooseUsResource::collection($query);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(ChooseUs $chooseUs,$id)
    {
        $chooseUs = ChooseUs::where('id',$id)->first();
        return new ChooseUsResource($chooseUs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(ChooseUsRequest $request, $id)
    {
        $chooseUs = ChooseUs::find($id);
        $chooseUs->update($request->only('title','description'));
        return response()->json(['message' => 'Updated successfully']);
    }
}
