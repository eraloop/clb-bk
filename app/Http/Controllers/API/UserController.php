<?php

namespace App\Http\Controllers\API;

use App\Models\r;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = $request->user();
        return response([ 'user' =>  $users,
        'success' => true], 200);
    }

    public function update_user_details(Request $request){

        $user = $request->user();

        if($user->update($request->all())){
            return response([
                "title"=> "Success",
                "message" => "User Profile updated successfully",
                'success' => true,
                'user details' => $request->all(),
                "statusCode" => 201,
            ], 201);
        }
    }

}
