<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Food;
use App\Order;
use App\table;
use Carbon\Carbon;
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
        $bill->paid = 1;
        

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



    public function today(){
        $reports = Bill::whereDate('created_at', Carbon::today())->get();

        $total_bill = 0;
        $total_discount = 0;
        $total_vat = 0;
        $total_service_charge = 0;
        $total_payable = 0;
        $total_pay_by_cash = 0;
        $total_pay_by_bkash = 0;
        $total_pay_by_card = 0;
        $total_veg = 0;
        $total_non_veg = 0;

        foreach($reports as $report){
            $total_bill += $report->total;
            $total_discount += $report->discount;
            $total_vat += $report->vat;
            $total_service_charge += $report->service_charge;
            $total_payable += $report->payable;
            $total_pay_by_cash += $report->pay_by_cash;
            $total_pay_by_bkash += $report->pay_by_bkash;
            $total_pay_by_card += $report->pay_by_card;
            
            foreach($report->order as $order){
                if($order->type == 'non-veg'){
                    $total_non_veg += $order->total;
                }

                if($order->type == 'veg'){
                    $total_veg += $order->total;
                }
            }
        }

        
      

        $allreport = [  'total'     => $total_bill,
                        'discount'  => $total_discount, 
                        'vat'       => $total_vat,
                        'service'   => $total_service_charge, 
                        'payable'   => $total_payable, 
                        'cash'      => $total_pay_by_cash, 
                        'bkash'     => $total_pay_by_bkash, 
                        'card'      => $total_pay_by_card, 
                        'veg'       => $total_veg, 
                        'non_veg'   => $total_non_veg
                    ];
        $today = Carbon::today()->format('d-m-Y');
        return view('pages.today', compact('allreport','today'));

      

        
    }

    public function pick(Request $request)
    {
        $reports = Bill::whereBetween('created_at', [Carbon::parse($request->from),Carbon::parse($request->to)])->get();
        $total_bill = 0;
        $total_discount = 0;
        $total_vat = 0;
        $total_service_charge = 0;
        $total_payable = 0;
        $total_pay_by_cash = 0;
        $total_pay_by_bkash = 0;
        $total_pay_by_card = 0;
        $total_veg = 0;
        $total_non_veg = 0;

        foreach($reports as $report){
            $total_bill += $report->total;
            $total_discount += $report->discount;
            $total_vat += $report->vat;
            $total_service_charge += $report->service_charge;
            $total_payable += $report->payable;
            $total_pay_by_cash += $report->pay_by_cash;
            $total_pay_by_bkash += $report->pay_by_bkash;
            $total_pay_by_card += $report->pay_by_card;
            
            foreach($report->order as $order){
                if($order->type == 'non-veg'){
                    $total_non_veg += $order->total;
                }

                if($order->type == 'veg'){
                    $total_veg += $order->total;
                }
            }
        }

        
      

        $allreport = [  'total'     => $total_bill,
                        'discount'  => $total_discount, 
                        'vat'       => $total_vat,
                        'service'   => $total_service_charge, 
                        'payable'   => $total_payable, 
                        'cash'      => $total_pay_by_cash, 
                        'bkash'     => $total_pay_by_bkash, 
                        'card'      => $total_pay_by_card, 
                        'veg'       => $total_veg, 
                        'non_veg'   => $total_non_veg
                    ];

        



        $d = [];
        $sd = [];
        foreach($reports as $report){
            $date = $report->created_at->format('d-m-Y');
            $s = $report->created_at->format('Y-m-d');
            array_push($d, $date);
            array_push($sd, $s);
        }
        $d1 = array_unique($d);
        $sd1 = array_unique($sd);
        $dates = [];
        $sdates = [];

        foreach($d1 as $item){
            array_push($dates, $item);
        }

        foreach($sd1 as $item){
            array_push($sdates, $item);
        }
        sort($dates);
        sort($sdates);

        $dailyReps = [];

        foreach($sdates as $key => $item){
            $arr = ['date'=> '', 'total'=>''];
            $dailyReport = Bill::whereDate('created_at', Carbon::parse($item))->get();
            $dayTotal = 0;
            foreach($dailyReport as $rep){
                $dayTotal+= $rep->payable;
            }
            $arr['date'] = $dates[$key];
            $arr['total'] = $dayTotal;
            array_push($dailyReps, $arr);
        }
        $today = Carbon::parse($request->from)->format('d-m-Y').' __ To __ '.Carbon::parse($request->to)->format('d-m-Y');
        return view('pages.pick', compact('allreport', 'dailyReps', 'today'));
        

    }

}
