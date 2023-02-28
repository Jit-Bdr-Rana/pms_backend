<?php

namespace App\Http\Controllers;

use App\Models\MyShares;
use Error;
use Illuminate\Http\Request;
use Validator;
class MySharesController extends Controller
{
    public function store(Request $request){
        $validator=Validator::make($request->all(),[
          'transaction_date'=>'date',
          'company_name'=>'string|required',
          'debit_quantity'=>'integer',
          'balance_after_transaction'=>'integer',
          'credit_quantity'=>'integer',
          'price'=>'integer'
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
      $my_shares=MyShares::create(
        [

            'transaction_date'=>$request->transaction_date,
            'company_name'=>$request->company_name,
            'debit_quantity'=>$request->debit_quantity,
            'balance_after_transaction'=>$request->balance_after_transaction,
            'credit_quantity'=>$request->credit_quantity,
            'price'=>$request->price
        ]
      );
      return response()->json(['message'=>'successfully created shares','status'=>true,'data'=>$my_shares,201]);
    }catch(Exception $ex){
      return response()->json(['errors'=>'server fail','status'=>false,500]);
    }
      }  //


      public function getAll(){
        try{
          $my_shares=MyShares::all();
          return response()->json(['message'=>'successfully get shares record','status'=>true,'data'=>$my_shares,201]);
      }catch(Exception $ex){
          return response()->json(['errors'=>'server fail','status'=>false,500]);
      }
      }


      public function update(Request $request,$id){
        $validator=Validator::make($request->all(),[
          'transaction_date'=>'date',
          'company_name'=>'string|required',
          'debit_quantity'=>'integer',
          'balance_after_transaction'=>'integer',
          'credit_quantity'=>'integer',
          'price'=>'integer'
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
        $my_shares=MyShares::find($id);
        if($my_shares){
            $my_shares->transaction_date=$request->transaction_date??$my_shares->transaction_date;
            $my_shares->company_name=$request->company_name??$my_shares->company_name;
            $my_shares->debit_quantity=$request->debit_quantity??$my_shares->debit_quantity;
            $my_shares->balance_after_transaction=$request->balance_after_transaction??$my_shares->balance_after_transaction;
            $my_shares->credit_quantity=$request->credit_quantity??$my_shares->credit_quantity;
            $my_shares->price=$request->price??$my_shares->price;
            $my_shares->save();
        }
        return response()->json(['message'=>'successfully updated shares','status'=>true,'data'=>$my_shares],201);

      }catch(Exception $ex){
        return response()->json(['errors'=>'server fail','status'=>false,500]);
      }
     }


     public function getById($id){
        try{
            $my_shares=MyShares::find($id);
            return response()->json(['message'=>'successfully get role','status'=>true,'data'=>$my_shares,200]);
        }catch(Exception $ex){
            return response()->json(['errors'=>'server fail','status'=>false,500]);
        }
      }


      public function delete($id){
        try{
            $my_shares=MyShares::find($id);
            $my_shares->delete();
            return response()->json(['message'=>'successfully deleted shares','status'=>true,'data'=>$my_shares,200]);
        }catch(Exception $ex){
            return response()->json(['errors'=>'server fail','status'=>false,500]);
        }
      }
}
