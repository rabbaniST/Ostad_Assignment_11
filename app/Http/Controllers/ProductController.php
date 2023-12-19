<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    
    function index()
    {

        $products = DB::table("products")->paginate(4);

        return view('pages.index', [
            'products' => $products
        ]);
    }

    // Create Methods
    function create()
    {
        return view('pages.create');
    }


     /**
     * Store the product
     */
    function store(Request $request)
    {
        $this->validate($request,[

            'name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ]);


        DB::table('products')->insert([
            'product_name' => $request->input('name'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price')
        ]);


        return redirect()->route('product.index')->with('success', 'Product created has been successfully.');
    }

    /**
     * Edit the product
     */
    function edit($id)
    {
        $products = DB::table('products')->find($id);
        return view('pages.edit', ['products' => $products]);
    }

    /**
     * Update the product
     */
    function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ]);

        DB::table('products')->where('id', $id)->update([
            'product_name' => $request->input('name'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price')
        ]);
        return redirect()->route('product.index')->with('updated', 'Product Updated has been successfully.');
    }

    /**
     * Delete Methods 
     */
    function delete($id)
    {
        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('product.index')->with('danger', 'Product Deleted has been successfully.');
    }

    /**
     * Sale Methods for get products
     */
    function sale()
    {
        $products = DB::table("products")->get();

        return view('pages.sale', [
            'products' => $products
        ]);
    }

    /**
     * Sale Store Methods sell products
     */
    function saleStore(Request $request)
    {

        $this->validate($request,[

            "customer_name"=> 'required|string',
            'product_name' => 'required|string',
            'quantity' => 'required|integer',
            
        ]);

        // Get product information from the products table
        $product = DB::table('products')->where('id', $request->input('product_name'))->first();
        $p_quantity = $product->quantity;
        $t_quantity = $request->input('quantity');


        if ($p_quantity < 1) {
            return redirect()->back()->with('error', 'This product is out of stock.');
        }elseif($p_quantity < $t_quantity){
            return redirect()->back()->with('error', 'This product is low stock.');
        }


        // Calculate 
        $update_quantity = $p_quantity - $t_quantity;

        // Calculate total price
        $totalPrice = $product->price * $request->input('quantity');

        // Insert data into the transactions table
        DB::table('transactions')->insert([
            'customer_name' => $request->input('customer_name'),
            'product_id' => $product->id,
            'product_name' => $product->product_name,
            'quantity' => $request->input('quantity'),
            'unit_price' => $product->price,
            'total_price' => $totalPrice
        ]);

        DB::table('products')->where('id', $product->id)->update([
            'quantity' => $update_quantity
        ]);

        return redirect()->route('product.transactions')->with('sale', 'Product sold has been successfully.');
    }


    /**
     * Transcations  Methods for calculatoin 
     */
    function transactions()
    {

        //return view('pages.transactions', compact('transactions'));
        $transactions = DB::table("transactions")->paginate(5);

        return view('pages.transactions', [
            'transactions' => $transactions
        ]);
    }
}
