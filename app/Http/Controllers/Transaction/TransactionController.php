<?php

namespace App\Http\Controllers\Transaction;
use App\Transaction;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions  = Transaction::all();
        if($transactions){
            return response()->json([
                'message' => 'Success',
                'results' => ['transactions' => $transactions],
                'status_code' => 200
            ], 200);
        }
        return response()->json([
            'message' => 'Success. No records found',
            'result' => [],
            'status_code' => 200
        ], 200);
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
        $validate  = $request->validate([
            'product_id' => 'required|int',
            'user_id' => 'required|int',
            'amount' => 'required|numeric',
            'quantity' => 'required|numeric'
        ]);

        if($validate){
            $transaction = Transaction::create([
                'product_id' => $request->product_id,
                'user_id' => $request->user_id,
                'amount' => $request->amount,
                'quantity' => $request->quantity
            ]);
            if($transaction){
                return response()->json([
                    'message' => 'Successfully made a transaction',
                    'result' => ['transaction' => $transaction],
                    'status_code' => 201
                ], 201);
            }
            return response()->json([
                'message' => 'Error. Something went wrong. Please Check and try again',
                'result' => ['transaction' => $transaction],
                'status_code' => 400
            ], 400);
        }
        return response()->json([
            'message' => 'Error. Please provide all the required fields',
            'result' => [],
            'status_code' => 400
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);
        if($transaction){
            return response()->json([
                'message' => 'Successfully found a record',
                'result' => ['transaction' => $transaction],
                'status_code' => 200
            ], 200);
        }
        return response()->json([
            'message' => 'Success. No record was found',
            'result' => ['transaction' => $transaction],
            'status_code' => 200
        ], 200);
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
        $transaction = Transaction::find($id);
        $validate  = $request->validate([
            'amount' => 'required|numeric',
            'quantity' => 'required|numeric'
        ]);
        if($validate){
            $transaction->amount = $request->amount;
            $transaction->quantity = $request->quantity;
            $saved  = $transaction->save();
            if($saved){
                return response()->json([
                    'message' => 'Successfully updated a transaction',
                    'result' => [],
                    'status_code' => 201
                ], 201);
            }
            return response()->json([
                'message' => 'Something went wrong. Try again',
                'result' => [],
                'status_code' => 400
            ], 400);
        }
        return response()->json([
            'message' => 'Please provide all required fields',
            'result' => [],
            'status_code' => 400
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if($transaction){
            $transaction->delete();
            return response()->json([
                'message' => 'Successfully deleted transaction',
                'result' => [],
                'status_code' => 200
            ], 200);
        }
        return response()->json([
            'message' => 'Success. No record was found',
            'result' => [],
            'status_code' => 200
        ], 200);
    }
}
