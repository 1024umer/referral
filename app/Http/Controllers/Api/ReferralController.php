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
    
}
