<?php

namespace App\Http\Controllers;

use App\Http\Resources\MySharesResource;
use App\Models\MyShares;
use Error;
use Illuminate\Http\Request;
use Validator;
use \Exception;

class MySharesController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'transaction_date' => 'date',
            'company_id' => 'integer|required',
            'debit_quantity' => 'integer',
            'balance_after_transaction' => 'integer',
            'credit_quantity' => 'integer',
            'price' => 'integer',
            'quantity' => 'integer',
            'trans_type' => 'string',
            // 'user_id'=>''

        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->getMessages();
            $error = [];
            foreach ($errors as $key => $value) {
                $error[$key] = $value;
            }
            return response()->json(['errors' => $error, 'status' => false], 400);
        }
        try {
            $my_shares = MyShares::create(
                [

                    'trans_type' => $request->trans_type,
                    'quantity' => $request->quantity,
                    'transaction_date' => $request->transcation_date ?? 0,
                    'debit_quantity' => $request->debit_quantity ?? 0,
                    'share_type' => $request->share_type ?? "IPO",
                    'balance_after_transaction' => $request->balance_after_transaction ?? 0,
                    'credit_quantity' => $request->credit_quantity ?? 0,
                    'company_id' => $request->company_id ?? 1,
                    'price' => $request->price ?? 0,
                    'user_id' => $request->user_id ?? 1

                ]
            );
            return response()->json(['message' => 'successfully created shares', 'status' => true, 'data' => $my_shares], 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => 'server fail', 'status' => false, 'error' => $ex], 500);
        }
    } //


    public function getAll()
    {
        try {
            $my_shares = MyShares::all();
            return response()->json(['message' => 'successfully get shares record', 'status' => true, 'data' => MySharesResource::collection($my_shares), 201]);
        } catch (Exception $ex) {
            return response()->json(['errors' => 'server fail', 'status' => false], 500);
        }
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'transaction_date' => 'date',
            'company_name' => 'string|required',
            'debit_quantity' => 'integer',
            'balance_after_transaction' => 'integer',
            'credit_quantity' => 'integer',
            'price' => 'integer',
            'quantity' => 'integer',
            'share_type' => 'string',
            'trans_type' => 'string'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->getMessages();
            $error = [];
            foreach ($errors as $key => $value) {
                $error[$key] = $value;
            }
            return response()->json(['errors' => $error, 'status' => false], 400);
        }
        try {
            $my_shares = MyShares::find($id);
            if ($my_shares) {
                $my_shares->trans_type = $request->trans_type ?? $my_shares->trans_type;
                $my_shares->transaction_date = $request->transaction_date ?? $my_shares->transaction_date;
                $my_shares->company_name = $request->company_name ?? $my_shares->company_name;
                $my_shares->debit_quantity = $request->debit_quantity ?? $my_shares->debit_quantity;
                $my_shares->balance_after_transaction = $request->balance_after_transaction ?? $my_shares->balance_after_transaction;
                $my_shares->credit_quantity = $request->credit_quantity ?? $my_shares->credit_quantity;
                $my_shares->price = $request->price ?? $my_shares->price;
                $my_shares->share_type = $request->share_type ?? $my_shares->share_type;
                $my_shares->save();
            }
            return response()->json(['message' => 'successfully updated shares', 'status' => true, 'data' => $my_shares], 201);

        } catch (Exception $ex) {
            return response()->json(['errors' => 'server fail', 'status' => false], 500);
        }
    }


    public function getById($id)
    {
        try {
            $my_shares = MyShares::find($id);
            return response()->json(['message' => 'successfully get role', 'status' => true, 'data' => MySharesResource::make($my_shares), 200]);
        } catch (Exception $ex) {
            return response()->json(['errors' => 'server fail', 'status' => false], 500);
        }
    }

    public function getByUserId($id)
    {
        // try {
        $my_shares = MyShares::where('user_id', $id)->get();
        // dd($my_shares);
        return response()->json(['message' => 'successfully get role', 'status' => true, 'data' => MySharesResource::collection($my_shares), 200]);
        // } catch (Exception $ex) {
        return response()->json(['errors' => 'server fail', 'error' => $ex, 'status' => false], 500);
        // }
    }


    public function delete($id)
    {
        try {
            $my_shares = MyShares::find($id);
            $my_shares->delete();
            return response()->json(['message' => 'successfully deleted shares', 'status' => true, 'data' => $my_shares, 200]);
        } catch (Exception $ex) {
            return response()->json(['errors' => 'server fail', 'status' => false, 500]);
        }
    }

    public function deleteByCompany($company_id)
    {
        try {
            $my_shares = MyShares::where('company_id', $company_id)->delete();
            return response()->json(['message' => 'successfully deleted shares', 'status' => true, 'data' => $my_shares, 200]);
        } catch (Exception $ex) {
            return response()->json(['errors' => 'server fail', 'status' => false, 500]);
        }
    }

}