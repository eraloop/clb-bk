<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response([ 'user' =>  $users,
        'success' => true], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validated->fails()) {
            return response(['message' => $validated->errors()->first()], 403);
        }

        if (!(auth('web')->validate($request->all()))) {
            return response([
                "title" => "Ooooppppps",
                'message' => "User email or password not correct",
                "user"=> $request->all(),
                "statusCode" => 401,
            ], 401);
        }

        $user = User::where(['email' => $request->email])->first();

        Auth::guard('api')->check($user);

        if(isset($user) && Hash::check($request->password, $user->password)){
            $token = $user->createToken('authToken')->accessToken;
            if ($token) {
                return response([
                    "title"=> "Success",
                    "message" => "User authentication successful",
                    'success' => true,
                    'user' => $user,
                    "statusCode" => 201,
                    'token' => $token,
                ], 201);
            } else {
                return response([
                    "title" => "Something when wrong",
                    'message' => "Server error,Please try again",
                    "code" => 500,
                ], 500);
            }
        }

    }

    public function register(Request $request)
    {

        $validated = Validator::make($request->all(),[
            "name"=> "required",
            "email" => "required",
            "password" => 'required',
            "phone" => 'required',
        ]);

        if ($validated->fails()) {
                return response(['message' => $validated->errors()->all()], 403);
        };

        $result = User::where(['email' => $request->email])->first();

        if($result){
            return response([
            "title" => "Oooh Sorry",
            "message" => "Email already taken, Please try again with a different email",
            'success' => false,
            "statusCode"=> 409,
            "email"=> $result->email,
        ], 409);
        }

        $user = User::create(
            [
                'name'=> $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,

            ]);

        Auth::guard('api')->check($user);

        $token = $user->createToken('authToken')->accessToken;

       if ($token) {
            return response([
                "title"=> "Success",
                "message" => "User authentication successful",
                'success' => true,
                'user' => $user,
                'token' => $token,
                "statusCode" => 201,

            ], 201);
        } else {
             return response([
                "title" => "Something when wrong",
                'message' => "Server error,Please try again",
                "code" => 500,
            ], 500);
        }

    }

    public function check_user_account(Request $request)
    {

        $validated = Validator::make($request->all(),[
            "email" => "required",
        ]);

        if ($validated->fails()) {
            return response(['message' => $validated->errors()->first()], 403);
        };

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

    public function set_new_password(Request $request){

        $validated = Validator::make($request->all(),[
            "email" => "required",
            "password" => "required"
        ]);

        if ($validated->fails()) {
                return response(['message' => $validated->errors()->first()], 403);
        };

        $user = User::where(['email' => $request->email])->first();

        $user->password = Hash::make($request->password);

        if($user->save()){
            return response([
                "title" => "Success",
                "message"=> "Password reset successful",
                "user" => $user,
            ], 200);
            
        }else{
            return response([
                "title" => "Server error",
                'message' => "Something when wrong, Please try again",
                "user"=> $request->all(),
                "statusCode" => 500,
            ], 500);
        }


    }

}
