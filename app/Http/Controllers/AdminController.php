<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Food;
use App\Order;
use App\table;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function foodShow(Request $request){

        $categories = $request->user()->categories;
        return view('pages.food', compact('categories'));
    }



    public function index()
    {
          
        $tables = request()->user()->table()->orderBy('name', 'asc')->get();
        
        return view('pages.table', compact('tables'));
    }

    public function order(Request $request){

        $table = table::where('table_id', $request->table)->first();
        $table->status = 1;
        $table->save();

        $bill = Bill::where('table_id', $request->table)->where('status', 1)->first();

        if(!$bill){
            $bill = new Bill();
            $bill->bill_id = time();
            $bill->table_id = $request->table;
            $bill->table_name = $table->name;
            $bill->total = 0;
            $bill->discount = 0;
            $bill->payable = 0;
            $bill->vat = 0;
            $bill->service_charge = 0;
            $bill->status = 1;
            $bill->user_id = $table->user_id;
            $bill->save();
        }
    

        foreach($request->food as $food){
            $foodItem = Food::where('food_id', $food['item'])->first();
            $order = new Order();
            $order->order_id = $bill->bill_id."-".Str::random(8);
            $order->bill_id = $bill->bill_id;
            $order->food_name = $foodItem->name;
            $order->price = $foodItem->price;
            $order->type = $foodItem->type;
            $order->quantity = $food['qty'];
            $order->total = $foodItem->price * $food['qty'];
            $order->save();

            $bill->total += $order->total;
            $bill->payable += $order->total;
            $bill->save();
        }

        return response()->json(['bill' => $bill->bill_id], 200);

    }


    public function orderex(Request $request){
        $bill = Bill::find($request->bill);
        $bill->discount = $request->discount;
        $bill->service_charge = $request->service;
        $bill->vat = $request->vat;
        $bill->payable = $bill->total - $request->discount + $request->service + $request->vat;
   
        $bill->save();
        return $bill;
    }


    public function payment(Request $request){
        $bill = Bill::find($request->bill);
        $bill->pay_by_cash = $request->cash;
        $bill->pay_by_card = $request->card;
        $bill->pay_by_bkash = $request->bkash;
        $bill->status = 0;
        

        $bill->save();

        $table = table::where('table_id', $bill->table_id)->first();
        $table->status = 0;
        $table->save();
        return $bill;

    }


    public function report(Request $request){
        $bills = $request->user()->bill()->orderBy('created_at','desc')->get();
        return view('pages.report', compact('bills'));
    }

}
