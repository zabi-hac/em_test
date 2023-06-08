<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    //



    function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        // print_r($data);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    function register(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required|min:3',
            'password' => 'required|min:6',

        ]);


        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->getMessageBag(),
                'validation_fail' => $validator->fails()
            ]);
        } else {

            try {
                $status =  DB::table('users')->insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
            } catch (\Illuminate\Database\QueryException $ex) {
                return response()->json([
                    'message' =>  'Database error: ' . substr($ex->getMessage(), 0, strpos($ex->getMessage(), '(')), // message part for user
                    'complete_message' => $ex->getMessage() // message part for  user
                ], 401);
            }


            return response()->json([
                'status' =>  $status ?? '',
                'message' =>  'registered successfully.',
            ], 200);
        }
    }
}
