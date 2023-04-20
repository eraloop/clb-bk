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


    public function checkUser(Request $request)
    {
        $user = User::where(['email' => $request->email])->first();
        if(!$user){
            return response([
                "title" => "Ooooppppps",
                'message' => "Account not found",
                "user"=> $request->all(),
                "statusCode" => 404,
            ], 404);
        }
        return response([
            "title" => "Success",
            'message' => "User account found",
            "user"=> $request->all(),
            "statusCode" => 200,
        ], 200);
    }

    public function resetPassword(){


    }

    public function updateUserInfo(){
        // 'eligibility_status'=> $request->eligibility_status,
        // 'resp_promoter'=> $request->resp_promoter,
        // 'sin' => $request->sin,
    }

}
