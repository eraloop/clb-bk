<?php

namespace App\Http\Controllers\API;

use App\Models\r;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = $request->user();
        return response([ 'user' =>  $users,
        'success' => true], 200);
    }



    public function update_user_details(Request $request){

        $user = $request->user();

        $user->email = $request->email;


        // 'eligibility_status'=> $request->eligibility_status,
        // 'resp_promoter'=> $request->resp_promoter,
        // 'sin' => $request->sin,
    }

}
