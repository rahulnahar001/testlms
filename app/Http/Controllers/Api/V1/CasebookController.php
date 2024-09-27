<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Casebook;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCasebookRequest;
use App\Http\Requests\UpdateCasebookRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\CasebookResource;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CasebookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return CasebookResource::collection(Casebook::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCasebookRequest $request)
    {
        $casebook = Casebook::create($request->validated());

        return CasebookResource::make($casebook);
    }

    /**
     * Display the specified resource.
     */
    public function show(Casebook $casebook)
    {
        return CasebookResource::make($casebook);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCasebookRequest $request, Casebook $casebook)
    {

        try {
            $casebook->update($request->validated());
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }

        return CasebookResource::make($casebook);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Casebook $casebook)
    {
        $casebook->delete();

        return response()->noContent();
    }
}
