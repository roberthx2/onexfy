<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VariationRequest;
use App\Http\Resources\VariationResource;
use App\Http\Resources\VariationCollection;
use App\Repositories\Intefaces\VariationRepositoryInterface;

class VariationController extends Controller
{
    private VariationRepositoryInterface $variationRepository;

    public function __construct(VariationRepositoryInterface $variationRepository) 
    {
        $this->variationRepository = $variationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new VariationCollection($this->variationRepository->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VariationRequest $request)
    {         
        return new VariationResource($this->variationRepository->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new VariationResource($this->variationRepository->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VariationRequest $request, $id)
    {         
        return new VariationResource($this->variationRepository->update($id, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return new VariationResource($this->variationRepository->delete($id));
    }
}
