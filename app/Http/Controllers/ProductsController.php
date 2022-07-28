<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('products' ,compact('products'));
    }

    public function data(Request $request)
    {
        $data = Product::get();
        return Datatables::of($data)->make(true);
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
        try
        {
            Product::create($request->all());
            return response()->json( ['status' => 200 , 'message' => 'تم الحفظ بنجاح' ] );
        }
        catch (\Throwable $th)
        {
            return response()->json( ['message' => 'لم يتم الحفظ' ] );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(Product::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try
        {
            Product::where('id' , $request->product_id)->first()->update($request->all());
            return response()->json( ['status' => 200 , 'message' => 'تم التعديل بنجاح' ] );
        }
        catch (\Throwable $th)
        {
            return response()->json( ['message' => 'لم يتم الحفظ' ] );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id',$id)->delete();
        return response()->json( ['status' => 200 ] );
    }


}
