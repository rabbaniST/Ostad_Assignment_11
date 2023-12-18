<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    function dashboard()
    {
        $currentDate = Carbon::now()->toDateString();
        $yesterdayDate = Carbon::yesterday()->toDateString();
        $currentMonth = Carbon::now()->startOfMonth()->toDateString();
        $currentMonthEnd = Carbon::now()->endOfMonth()->toDateString();
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth()->toDateString();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth()->toDateString();

        $todaysSales = DB::table('transactions')
            ->selectRaw('SUM(total_price) as total_sales')
            ->whereDate('created_at', $currentDate)
            ->first();

        $yesterdaysSales = DB::table('transactions')
            ->selectRaw('SUM(total_price) as total_sales')
            ->whereDate('created_at', $yesterdayDate)
            ->first();

        $thisMonthsSales = DB::table('transactions')
            ->selectRaw('SUM(total_price) as total_sales')
            ->whereBetween('created_at', [$currentMonth, $currentMonthEnd])
            ->first();

        $lastMonthsSales = DB::table('transactions')
            ->selectRaw('SUM(total_price) as total_sales')
            ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->first();

        return view('dashboard')->with([
            'todaysSales' => $todaysSales,
            'yesterdaysSales' => $yesterdaysSales,
            'thisMonthsSales' => $thisMonthsSales,
            'lastMonthsSales' => $lastMonthsSales,
        ]);
    }



    function index()
    {

        $products = DB::table("products")->paginate(4);

        return view('pages.index', [
            'products' => $products
        ]);
    }

    function create()
    {
        return view('pages.create');
    }

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

    function edit($id)
    {
        $products = DB::table('products')->find($id);
        return view('pages.edit', ['products' => $products]);
    }

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

    function delete($id)
    {
        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('product.index')->with('danger', 'Product Deleted has been successfully.');
    }


    function sale()
    {
        $products = DB::table("products")->get();

        return view('pages.sale', [
            'products' => $products
        ]);
    }
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


    function transactions()
    {

        //return view('pages.transactions', compact('transactions'));
        $transactions = DB::table("transactions")->paginate(5);

        return view('pages.transactions', [
            'transactions' => $transactions
        ]);
    }
}
