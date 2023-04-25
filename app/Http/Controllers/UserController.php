<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use \Exception;
use Illuminate\Support\Str;
use Validator;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //'password'=>bcrypt($userPassowd)
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string',
                'email' => 'required|string|unique:users',
                'address' => 'string|required',
                'password' => 'string|required',
                'phone' => 'string|required',
            ], ['full_name.required' => 'full_name is required']);
            if ($validator->fails()) {
                $errors = $validator->errors()->getMessages();
                foreach ($errors as $key => $value) {
                    $error[$key] = $value;
                }
                return response()->json(['errors' => $error, 'status' => false], 400);
            }
            $user = User::create(
                [
                    'full_name' => $request->full_name,
                    'email' => $request->email,
                    'username' => $request->username ?? '',
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'role_id' => 2,
                    'shareholder_type' => 'individual',
                    'password' => bcrypt($request->password)
                ]
            );
            return response()->json(['message' => 'success', 'data' => $user], 201);
        } catch (Exception $ex) {
            return response()->json(['message' => 'fail', 'error' => $ex], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}