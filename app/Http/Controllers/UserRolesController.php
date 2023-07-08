<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storeuser_rolesRequest;
use App\Http\Requests\Updateuser_rolesRequest;
use App\Models\user_roles;

class UserRolesController extends Controller
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
     * @param  \App\Http\Requests\Storeuser_rolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeuser_rolesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user_roles  $user_roles
     * @return \Illuminate\Http\Response
     */
    public function show(user_roles $user_roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user_roles  $user_roles
     * @return \Illuminate\Http\Response
     */
    public function edit(user_roles $user_roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateuser_rolesRequest  $request
     * @param  \App\Models\user_roles  $user_roles
     * @return \Illuminate\Http\Response
     */
    public function update(Updateuser_rolesRequest $request, user_roles $user_roles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user_roles  $user_roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(user_roles $user_roles)
    {
        //
    }
}
