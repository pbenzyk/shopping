<?php

namespace App\Http\Controllers;

use App\Order;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        //
    }
    public function checkCard(Request $request)
    {
        $product = DB::table('product')
            ->where('id_product', $request->get('product'))
            ->get();
        foreach ($product as $products) {
            $old_amount = number_format($products->amount_product);
        }
        $num = $request->get('num');
        $user = $request->get('user');
        $product = $request->get('product');
        $old = number_format($request->get('old_amount'));
        $price = number_format($request->get('price'));
        $new = $request->get('amount');
        $total_price = $new * $price;
        $total_amount = $old_amount - $new;
        //$total_amount = $product->amount_product - $new;
        if ($num == "4242424242424242") {
            DB::table('ordered')->insert(
                [
                    'id_user' => $user,
                    'id_product' => $product,
                    'total_amount' => $new,
                    'total_price' => $total_price,
                    'created_at' => DB::raw('now()'),
                    'updated_at' => DB::raw('now()'),
                ]
            );
            DB::table('product')
                ->where('id_product', $product)
                ->update([
                    'amount_product' => $total_amount,
                    'updated_at' => DB::raw('now()'),
                ]);
            $ordered = DB::table('ordered')
                ->join('product', 'product.id_product', '=', 'ordered.id_product')
                ->join('type_product', 'product.type_product', '=', 'type_product.id_type')
                ->select('type_product.*', 'product.*', 'ordered.*')
                ->where('ordered.id_user', '=', $user)
                ->get();
            return redirect('/view/order/' . $user);

        } elseif ($num == "2222222222222222") {
            //return 2;
            return redirect('/user/show_stock/' . $request->get('product'))->with('openM', 'วงเงินเต็ม');
        } else {
            return redirect('/user/show_stock/' . $request->get('product'))->with('openM', 'รหัสไม่ถูกต้อง');
        }
    }
    public function check(Request $request)
    {
        $user = $request->get('user');
        $product = $request->get('product');
        $old = number_format($request->get('old_amount'));
        $price = number_format($request->get('price'));
        $new = $request->get('amount');
        $total = $new * $price;

        if ($new <= $old) {
            return redirect('/user/show_stock/' . $request->get('product'))->with('open', $new);
        } else {
            return redirect('/user/show_stock/' . $request->get('product'))->with('error', 'สินค้าไม่พอจำหน่าย');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ordered = DB::table('ordered')
            ->join('product', 'product.id_product', '=', 'ordered.id_product')
            ->join('type_product', 'product.type_product', '=', 'type_product.id_type')
            ->select('type_product.*', 'product.*', 'ordered.*')
            ->where('ordered.id_user', '=', $id)
            ->get();
        return view('/user/cart/order', compact('ordered'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

}
