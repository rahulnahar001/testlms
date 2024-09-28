<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Cashbook;
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
        $Cashbook = Cashbook::create($request->validated());

        return CashbookResource::make($Cashbook);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cashbook $Cashbook)
    {
        return CashbookResource::make($Cashbook);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCashbookRequest $request, Cashbook $Cashbook)
    {

        try {
            $Cashbook->update($request->validated());
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }

        return CashbookResource::make($Cashbook);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cashbook $Cashbook)
    {
        $Cashbook->delete();

        return response()->noContent();
    }
}
