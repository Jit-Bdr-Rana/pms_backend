<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Role;
use \Exception;
class RoleController extends Controller
{


//    function to store role

 public function store(Request $request){
    $validator=Validator::make($request->all(),[
        'name'=>'string|required'
   ]);

  if($validator->fails()){
    $errors=$validator->errors()->getMessages();
    $error=[];
    foreach($errors as $key=>$value){
        $error[$key]=$value;
    }
    return response()->json(['errors'=>$error,'status'=>false],400);
  }

  try{

    $role=Role::create([
        'name'=>$request->name
    ]);
    return response()->json(['message'=>'successfully created role','data'=>$role,'status'=>true,201]);

  }catch(Exception $ex){
    return response()->json(['errors'=>'server fail','status'=>false,500]);
  }
 }

 public function update(Request $request,$id){
    $validator=Validator::make($request->all(),[
        'name'=>'string|required'
   ]);

  if($validator->fails()){
    $errors=$validator->errors()->getMessages();
    $error=[];
    foreach($errors as $key=>$value){
        $error[$key]=$value;
    }
    return response()->json(['errors'=>$error,'status'=>false],400);
  }
  try{
    $role=Role::find($id);
    if($role){
        $role->name=$request->name;
        $role->save();
    }
    return response()->json(['message'=>'successfully updated role','status'=>true,'data'=>$role],201);

  }catch(Exception $ex){
    return response()->json(['errors'=>'server fail','status'=>false,500]);
  }
 }

  public function getAll(){
    try{
        $roleList=Role::all();
        return response()->json(['message'=>'successfully created role','status'=>true,'data'=>$roleList,201]);
    }catch(Exception $ex){
        return response()->json(['errors'=>'server fail','status'=>false,500]);
    }
  }


  public function getById($id){
    try{
        $roleList=Role::find($id);
        return response()->json(['message'=>'successfully created role','status'=>true,'data'=>$roleList,200]);
    }catch(Exception $ex){
        return response()->json(['errors'=>'server fail','status'=>false,500]);
    }
  }

  public function delete($id){
    try{
        $roleList=Role::find($id);
        $roleList->delete();
        return response()->json(['message'=>'successfully deleted record','status'=>true,'data'=>$roleList,200]);
    }catch(Exception $ex){
        return response()->json(['errors'=>'server fail','status'=>false,500]);
    }
  }

}
