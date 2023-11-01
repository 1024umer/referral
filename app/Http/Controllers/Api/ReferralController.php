<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
class ReferralController extends Controller
{
    public function index()
    {
        // Retrieve only users who have referred others
        $referrers = User::whereHas('referredUsers')
        ->with(['referredUsers:id,first_name,last_name']);
    
        if (isset($_GET['role_id'])) {
            $referrers->where('role_id', $_GET['role_id']);
        }
    
        if (isset($_GET['perpage']) && intval($_GET['perpage']) > 0) {
            $referrers = $referrers->paginate($_GET['perpage']);
        } else {
            $referrers = $referrers->get();
        }
    
        return UserResource::collection($referrers);
    }
    public function show($id, Request $request){
        $referrals = User::where('referral_id', $id);
    
        if ($request->has('role_id')) {
            $referrals->where('role_id', $request->input('role_id'));
        }
    
        $perpage = $request->input('perpage', 10); // Default to 10 if 'perpage' is not provided.
        $referrals = $referrals->paginate($perpage);
    
        return new UserResource($referrals);
    }
    
}
