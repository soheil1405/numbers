<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRolsRequest;
use App\Http\Requests\UpdateRolsRequest;
use App\Models\Rols;

class RolsController extends Controller
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
     * @param  \App\Http\Requests\StoreRolsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRolsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rols  $rols
     * @return \Illuminate\Http\Response
     */
    public function show(Rols $rols)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rols  $rols
     * @return \Illuminate\Http\Response
     */
    public function edit(Rols $rols)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRolsRequest  $request
     * @param  \App\Models\Rols  $rols
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRolsRequest $request, Rols $rols)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rols  $rols
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rols $rols)
    {
        //
    }
}
