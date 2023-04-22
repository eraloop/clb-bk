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

        $validated = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'resp_promoter'=> 'required'
        ]);

        if ($validated->fails()) {
            return response(['message' => $validated->errors()->first()], 403);
        };

        $email = $request->all()['email'];
            Mail::to($email)->send(new UserContactUs($email, $request->all()));
            return response(
                [
                    'success' => true,
                    'message' => "Thank you, Your request will be handled as soon as possible"
                ], 200
            );
    }

}
