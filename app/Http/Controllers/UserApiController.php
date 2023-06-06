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
        $validator =  Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->getMessageBag(),
                'validation_fail' => $validator->fails()
            ]);
        } else {

            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'These credentials do not match our records.',
                    'status' => 401
                ]);
            }

            session([
                'user_id' => $user->id,
                'user_name' => $user->name,

            ]);


            return response()->json([
                'status' => 200,
                'message' => 'logged in successfully',
                'username' => $user->name,
                // session()->all(),
                // Config::get('session.lifetime') * 60,
            ]);
        }
    }

    function register(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required|min:3',
            'password_2' => 'required|min:6',

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
                    'password' => Hash::make($request->password_2)
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
