<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Cashbook;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCashbookRequest;
use App\Http\Requests\UpdateCashbookRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\CashbookResource;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CashbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return CashbookResource::collection(Cashbook::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCashbookRequest $request)
    {
        try {
          $cashbook = Cashbook::create($request->validated());
          $id = $cashbook->customer_id;
          $customer = Customer::findOrFail($id);
          $customerWithCashbook = Customer::with('cashbooks')->findOrFail($id);
          $cashbooks = $customerWithCashbook->cashbooks;
          $balances = [];
          foreach ($cashbooks as $cashbook) {
            $transactionAmount = ($cashbook->credit_type) ? $cashbook->credit_balance : '-' . $cashbook->credit_balance;
            $balances[] =  $transactionAmount;
          }
          $customer->credit_balance = array_sum($balances);
          $customer->save();
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }

        return CashbookResource::make($cashbook);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cashbook $cashbook)
    {
        return CashbookResource::make($cashbook);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCashbookRequest $request, Cashbook $cashbook)
    {

        try {
            $cashbook->update($request->validated());
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }

        return CashbookResource::make($cashbook);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cashbook $cashbook)
    {
        $cashbook->delete();

        return response()->noContent();
    }
}
