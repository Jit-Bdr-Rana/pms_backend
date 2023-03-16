<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Resources\CurrentUserResource;

class AuthController extends Controller
{
    /**
     * for making user login
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        // try {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $credential = $request->only(['email', 'password']);

        $user = User::where('email', $request->email)->first();
        //this part is used for checking password reset
        if (!$user) {
            return response()->json([
                'status' => false,
                'errors' => 'email not found',
            ], 401);
            // if (!$user->is_active)
            //   // return $this->userBlocked();
            //   if (Hash::check($request->password, $user->password)) {


            //   }
        }


        //authentication part
        if (!Auth::attempt($credential)) {
            return response()->json([
                'status' => false,
                'errors' => 'email and password did not match',
            ], 401);
        }

        // token creation
        $token = $user->createToken('authToken')->plainTextToken;


        $result['user'] = new CurrentUserResource($user);
        $result['accessToken'] = $token;
        return response()->json(['status' => true, 'message' => 'login successful', 'data' => $result, 'reset' => false], 200);
        // } catch (\Exception $ex) {
        // return response()->json(['status' => false, 'message' => 'login fail', 'data' => $ex, 'reset' => false], 500);
        // }

    }

    public function current(Request $req)
    {
        // dd($req->user());
        return response()->json(['message' => 'current logged in user', 'data' => new CurrentUserResource($req->user()), 'status' => true], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'successfully logout', 'status' => true], 200);
    }

}