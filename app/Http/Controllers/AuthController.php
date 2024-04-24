<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function createToken(Request $request)
    {
        // validate email and password
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc|max:255',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ],422);
        }

        // in production we'd use something like sanctum to manage this
        // return the api token as a response

        return response()->json([
            'token' => env('FIXED_API_TOKEN')
        ]);
    }

    public function readToken(Request $request)
    {
        // validate api token
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ],422);
        }

        // handle if token not found
        if($request->query('token') !== env('FIXED_API_TOKEN')){
            return response()->json([
                'message' => 'Token not found.'
            ],403);
        }

        // return user data if the token matches
        $reponseData = [
            'user' => 'Example User',
            'email' => 'email@address.com'
        ];

        return response()->json($reponseData);
    }

    public function updateToken(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ],422);
        }

        if($request->query('token') !== env('FIXED_API_TOKEN')){
            return response()->json([
                'message' => 'Token not found.'
            ],403);
        }

        // this is where you'd refresh the token and generate a new one
        // return back to the response

        return response()->json([
            'message' => 'Token updated successfully',
            'token' => env('FIXED_API_TOKEN')
        ]);
    }

    public function deleteToken(Request $request)
    {
        // standard validatiom, validation requests would be
        // better suited to prevent DRY and keep clean and logic separate
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ],422);
        }

        if($request->query('token') != env('FIXED_API_TOKEN')){
            return response()->json([
                'message' => 'Token not found.'
            ],403);
        }

        // in production take the token and destroy it
        // used in cases where the client logs out
        return response()->json([
            'message' => 'Token deleted successfully',
        ]);
    }

}
