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
                'username' => 'required|string|unique:users',
                'address' => 'string|required',
                'password' => 'string|required',
                'phone' => 'string|required',
                'role_id' => 'integer|required',
                'shareholder_type' => 'integer|required',
            ], ['firstName.required' => 'firstName is required']);
            if ($validator->fails()) {
                $errors = $validator->errors()->getMessages();
                foreach ($errors as $key => $value) {
                    $error[$key] = $value;
                }
                return response()->json(['errors' => $error, 'status' => false], 400);
            }
            DB::transaction(function () use ($request, &$validator, &$userPassowd, &$user, &$plainTextToken) {
                $user = User::create(
                    array_merge(
                        [
                            'full_name' => $request->full_name,
                            'email' => $request->email,
                            'username' => $request->email,
                            'address' => $request->email,
                            'phone' => $request->phone,
                            'role_id' => $request->role_id,
                            'shareholder_type' => $request->shareholder_type,
                        ],
                        ['password' => bcrypt($request->password)]
                    )
                );
            });
            $response['user'] = $user;
            $response['password'] = $userPassowd;
            return response()->json(['message' => $this->createdMessage, 'data' => $response], 201);
        } catch (Exception $ex) {
            return $this->serverError();
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