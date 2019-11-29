<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\TypeProduct;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TypeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeProduct = TypeProduct::all();
        return view('/admin/type', compact('typeProduct'));
    }
    public function view()
    {
        $typeProduct = DB::table('type_product')->get();
        return view('/user/view', compact('typeProduct'));
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
        $typeProduct = new TypeProduct;
        $typeProduct->name_type = $request->get('typename');
        $typeProduct->img_type = $image;
        $typeProduct->save();
        return redirect('/admin/index')->with('success', 'เพิ่มหมวดหมู่สำเร็จ');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\TypeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function show($id_type)
    {
        $typeProduct = DB::table('type_product')
            ->join('product', 'type_product.id_type', '=', 'product.type_product')
            ->select('type_product.*', 'product.*')
            ->where('product.type_product', '=', $id_type)->get();

        return view('/user/showAllScock', compact('typeProduct'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id_type)
    {
        $typeProduct = DB::table('type_product')
            ->where('id_type', '=', $id_type)->get();
        return view('/admin/editType', compact('typeProduct', 'id_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_type)
    {
        if ($request->get('old')) {
            $image = $request->get('old');
        }
        if ($request->hasfile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('image', $image);
        }
        DB::table('type_product')
            ->where('id_type', $id_type)
            ->update(['name_type' => $request->get('typename'), 'img_type' => $image]);
        return redirect('/admin/index')->with('success', 'อัพเดตหมวดหมู่สำเร็จ');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_type)
    {
        DB::table('type_product')->where('id_type', '=', $id_type)->delete();
        return redirect('/admin/index')->with('success', 'ลบหมวดหมู่สำเร็จ');
    }
}
