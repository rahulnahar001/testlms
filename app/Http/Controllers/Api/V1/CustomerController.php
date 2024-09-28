<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return CustomerResource::collection(Customer::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->validated());

        return CustomerResource::make($customer);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $customer = Customer::with('cahebooks')->findOrFail($id);

        return response()->json($customer);
        return CustomerResource::make($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCustomerRequest $request, Customer $customer)
    {

        try {
            $customer->update($request->validated());
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }

        return CustomerResource::make($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->noContent();
    }
}
