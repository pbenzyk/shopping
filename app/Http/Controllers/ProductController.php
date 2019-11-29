<?php

namespace App\Http\Controllers;

use App\Product;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = DB::table('product')
            ->join('type_product', 'product.type_product', '=', 'type_product.id_type')
            ->select('type_product.*', 'product.*')
            ->get();
        $type_product = DB::table('type_product')
            ->get();
        return view('/admin/product', compact('product', 'type_product'));
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
        if ($request->hasfile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('image', $image);
        }
        $product = new Product;
        $product->name_product = $request->get('nameproduct');
        $product->type_product = $request->get('typeproduct');
        $product->price_product = $request->get('priceproduct');
        $product->amount_product = $request->get('amountproduct');
        $product->img_product = $image;
        $product->save();
        return redirect('/admin/product')->with('success', 'เพิ่มสินค้าสำเร็จ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('product')
            ->join('type_product', 'product.type_product', '=', 'type_product.id_type')
            ->select('type_product.*', 'product.*')
            ->where('product.id_product', '=', $id)->get();

        return view('/user/viewStock', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id_product)
    {
        $product = DB::table('product')
            ->join('type_product', 'product.type_product', '=', 'type_product.id_type')
            ->select('type_product.*', 'product.*')
            ->where('product.id_product', '=', $id_product)->get();
        $type_product = DB::table('type_product')
            ->get();
        return view('/admin/editProduct', compact('product', 'type_product','id_product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->get('old')) {
            $image = $request->get('old');
        }
        if ($request->hasfile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('image', $image);
        }
        DB::table('product')
            ->where('id_product', $id)
            ->update(['name_product' => $request->get('nameproduct'),
                'type_product' => $request->get('typeproduct'),
                'price_product' => $request->get('priceproduct'),
                'amount_product' => $request->get('amountproduct'),
                'img_product' => $image]);
        return redirect('/admin/product')->with('success', 'อัพเดตสินค้าสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('product')->where('id_product', '=', $id)->delete();
        return redirect('/admin/product')->with('success', 'ลบสินค้าสำเร็จ');
    }
}
