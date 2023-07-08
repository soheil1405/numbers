<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storenames;
use App\Models\names;
use App\Http\Requests\StorenamesRequest;
use App\Http\Requests\UpdatenamesRequest;

class NamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $items = names::latest()->paginate(100);





        $routeName = "names";


        $headers = [
            "آیدی ",
            "نام فارسی",
            "نام انگلیسی ",
            "نوع",
            "عملیات"
        ];




        return view('admin.pages.index', compact('items', 'routeName', 'headers'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routeName = "names";


        return view('admin.names.create', compact('routeName'));
    }


    public function store(Storenames $request)
    {


        names::create($request->only(['persian_name', 'english_name', 'type']));
        session()->flash('created', 'اسم جدید با موفقیت ذخیره شد');
        return redirect()->route('adminn.names.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\names  $names
     * @return \Illuminate\Http\Response
     */
    public function show(names $names)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\names  $names
     * @return \Illuminate\Http\Response
     */
    public function edit($names)
    {

        $name = names::findOrFail($names);
        $routeName = "EditName";
        return view('admin.names.edit', compact('routeName', 'name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatenamesRequest  $request
     * @param  \App\Models\names  $names
     * @return \Illuminate\Http\Response
     */
    public function update(Storenames $request)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\names  $names
     * @return \Illuminate\Http\Response
     */
    public function destroy($names)
    {
        dd($names);

    }
}