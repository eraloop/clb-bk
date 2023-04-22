<?php

namespace App\Http\Controllers\API;

use App\Mail\UserContactUs;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    public function contact_us(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'context'=> 'required',
            'resp_promoter'=> 'required'
        ]);

        if($validator->fails()){
            return new JsonResponse(
                [
                    'success' => false,
                    'message' => $validator->errors()
                ], 422
            );
        }


        $email = $request->all()['email'];
            Mail::to($email)->send(new UserContactUs($email, $request->all()));
            return new JsonResponse(
                [
                    'success' => true,
                    'message' => "Thank you for contacting customer support,your request will be handled as soon as possible"
                ], 200
            );
    }

}
