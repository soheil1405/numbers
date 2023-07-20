<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\orders;
use App\Http\Requests\StoreordersRequest;
use App\Http\Requests\UpdateordersRequest;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $showBy = $request->showBy;
        $items = orders::when($request->showBy, function ($query) use ($showBy) {

            switch ($showBy) {
                case 'company':
                    return $query->where('ComponyOrUser', 'c');
                    break;

                case 'user':
                    return $query->where('ComponyOrUser', 'u');
                    break;

                default:
                    # code...
                    break;
            }

        })->whereNotNull('marchant_id')->latest()->paginate(50);

        // dd($items[0]);


        $headers = [
            'کد سفارش',
            'ref_id',
            'ارگان / شخص',
            'نام پرداخت کننده',
            'نوع پرداخت',
            'تعداد پرداخت',
            'مبلغ پرداخت',
            'تاریخ پرداخت'
        ];


        $routeName = "orders";



        return view('admin.pages.index', compact('items', 'headers', 'routeName'));

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
     * @param  \App\Http\Requests\StoreordersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreordersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateordersRequest  $request
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateordersRequest $request, orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(orders $orders)
    {
        //
    }
}