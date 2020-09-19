@extends('layout.app')

@section('body-content')
    @if (Auth::user()->isAdmin)
        <div class="main-content">
    @else
        <div style="width:100%; display:block;">
    @endif
    <div class="container-fluid">
        <!-- page indicator start -->
        <section class="page-indicator">
            <div class="row">
                <div class="col-md-8">
                  <a href="{{route('home')}}" class="btn btn-warning">Home</a>
                </div>
                
                <div class="col-md-4 print-button">
                    <div class="text-center ">
                        @if(!$table->status)
                        <div  class="start-table">
                            <a class="btn bg-info show-table"> Start Table</a>
                            <div class="hotel-boy">
                                @foreach ($users as $user)
                                    <a href="{{route('startTable', [$table->table_id, $user->id])}}">{{$user->name}}</a>
                                @endforeach
                                
                             
                            </div>
                        </div>
                        @else
                        @if($table->bill()->where('status', 1)->first())
                        <p>by : {{$table->bill()->where('status', 1)->first()->by}}</p>
                        @endif
                            @if (Auth::user()->isAdmin)
                                <a href="{{ route('reset_table', $table->table_id) }}" class="btn btn-danger"> reset table</a>
                            @endif
                        <button class="bg-info" data-toggle="modal" data-target="#Bill"> guest bill</button>
                        <button class="invoice" data-toggle="modal" data-target="#invoice"> invoice</button>
                        
                        @endif
                        
                    </div>
                </div>
                
            </div>
        </section>
        <!-- page indicator end -->


<!-- Modal -->
@if($table->bill()->where('status', 1)->first())
<div class="modal fade" tabindex="-1" id="Bill" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Create Bill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>
                <input type="hidden" id="billId" value="{{$table->bill()->where('status', 1)->first()->bill_id}}">
                <input id="parvat" data-total="{{$table->bill()->where('status', 1)->first()->total}}" style="width:30%;margin:5px 0;" placeholder="Vat %" type="number">
                <input id="vat" style="width:60%; margin:5px 0;" placeholder="Vat tk" type="number">
            </p>
            <p>
                <input id="pardiscount" data-total="{{$table->bill()->where('status', 1)->first()->total}}" style="width:30%; margin:5px 0;" placeholder="Discount %" type="number">
                <input id="discount" style="width:60%; margin:5px 0;" placeholder="Discount tk" type="number">
            </p>
            <p>
                <input id="service" style="width:100%; margin:5px 0;" placeholder="Service Charge" type="number">
                
            </p>
            <p>
                <button id="submit">Submit</button>
                <button id="printGuestBill">Print</button>
            </p>
            <div id="guestBill">
                <div style="padding: 10px;background: #fff;box-shadow: #dad9d9 0px 7px 16px -3px;">
                    <h1 style="text-align: center;">
                        <img src="{{asset('asset/images/logo.png')}}">
                    </h1>
                    <p style="text-align: center; font-size:12px;">
                        Shop No-802, Grand Zam Zam Tower, (7th Floor Food Court), Uttara, Dhaka
                    </p>
                    <p style="text-align: center;font-size:12px;">
                        Cell: 01316-986471
                    </p>

                    <p style="text-align: center;font-size:12px;">
                        Guest Bill
                    </p>
                    
                    <hr>
                    @php
                        if($table->bill()->where('status', 1)->first()){
                            $orderId = $table->bill()->where('status', 1)->first()->bill_id;
                        }else{
                            $orderId = '';
                        }



                    @endphp
                    <h4>{{$table->name}}</h4>
                    <p  style="font-size: 11px;">Order Id : <span>{{$orderId}}</span></p>
                    <p  style="font-size: 11px;">Order Date : <span id="date1"></span></p>
                    <script> 
                        document.getElementById('date1').innerHTML = data.toLocaleDateString()+"--"+data.toLocaleTimeString()
                    </script>
                    <hr>
                    <div>
                        <!-- item start -->
                        <div>
                            <h2  style="text-align: center; font-size:16px;" >Order Info</h2>
                            <div style="display: flex; flex-wrap: wrap;  border-bottom: 1px solid black; margin-bottom:12px;">
                                <div style="flex: 0 0 50%;max-width: 50%;">
                                    <p style="font-size: 12px;">
                                        Item (rate * quantity)
                                    </p>
                                </div>
                                <div style="flex: 0 0 50%;max-width: 50%;">
                                    <p  style="font-size: 12px; text-align:right;">
                                       price
                                    </p>
                                </div>
                            </div>
                            <div style="display: flex;flex-wrap: wrap;">
                                @if($table->bill()->where('status', 1)->first())
                                    @foreach ($table->bill()->where('status', 1)->first()->order as $key => $order)
                                        
                                        <div style="flex: 0 0 50%;max-width: 50%;">
                                            <p style="font-size: 12px;">
                                               {{ $order->food_name}} ({{$order->price}} tk * {{$order->quantity}})
                                            </p>
                                        </div>
                                        <div style="flex: 0 0 50%;max-width: 50%;">
                                            <p style="font-size: 12px; text-align:right;">
                                            {{$order->total}} tk
                                            </p>
                                        </div>                                     
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <!-- item end -->
                    </div>
                    <div>
                        <hr>
                        <div style="display: flex; flex-wrap: wrap;">
                            <div style="flex: 0 0 50%;max-width: 50%;">
                                <p style="font-size: 12px;text-align:right;">
                                    Order Total :
                                </p>
                                <p style="font-size: 12px;text-align:right;">
                                    Vat :
                                </p>
                                <p style="font-size: 12px;text-align:right;">
                                    S. Charge :
                                </p>
                                <p style="font-size: 12px;text-align:right;">
                                    Discount :
                                </p>
                                <p style="font-size: 12px;text-align:right;">
                                    Payable :
                                </p>
                            </div>
                            <div style="flex: 0 0 50%;max-width: 50%;">
                                <p  style="font-size: 12px; text-align:right;">
                                   {{$table->bill()->where('status', 1)->first()->total}} tk
                                </p>
                                <p  style="font-size: 12px; text-align:right;">
                                    {{$table->bill()->where('status', 1)->first()->vat}} tk
                                 </p>
                                 <p  style="font-size: 12px; text-align:right;">
                                    {{$table->bill()->where('status', 1)->first()->service_charge}} tk
                                 </p>
                                 <p  style="font-size: 12px; text-align:right;">
                                    {{$table->bill()->where('status', 1)->first()->discount}} tk
                                 </p>
                                 <p  style="font-size: 12px; text-align:right;">
                                    {{$table->bill()->where('status', 1)->first()->payable}} tk
                                 </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <hr>
                        <p style="text-align: center;font-size:10px;border-bottom:1px solid black;">Thanks For Comming</p>
                    
                        <p style="text-align: center;font-size:9px;">Developed By: ssttechbd.com</p>
                    </div>
                    
                </div>
                
            </div>
        </div>
      </div>
    </div>
  </div>
  @endif





  {{-- model for invoice --}}

  
<!-- Modal -->
@if($table->bill()->where('status', 1)->first())
<div class="modal fade" tabindex="-1" id="invoice" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Create Bill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>
                <input type="hidden" id="billId" value="{{$table->bill()->where('status', 1)->first()->bill_id}}">
                <input type="hidden" id="tableId" value="{{$table->table_id}}">
                <span>Pay By Cash :</span>
                <input id="cash" style="width:60%; margin:5px 0;" placeholder="00 tk" type="number">
            </p>
            <p>
                <span>Pay By Bkash :</span>
                <input id="bkash" style="width:60%; margin:5px 0;" placeholder="00 tk" type="number">
            </p>
            <p>
                <span>Pay By Card :</span>
                <input id="card" style="width:60%; margin:5px 0;" placeholder="00 tk" type="number">
            </p>
           
            <p>
                <button id="wsubmit" onclick="payment();">Submit</button>
            </p>
            <div id="invoiceBill">
                <div style="padding: 10px;background: #fff;box-shadow: #dad9d9 0px 7px 16px -3px;">
                    <h1 style="text-align: center;">
                        <img src="{{asset('asset/images/logo.png')}}">
                    </h1>
                    <p style="text-align: center; font-size:12px;">
                        Shop No-802, Grand Zam Zam Tower, (7th Floor Food Court), Uttara, Dhaka
                    </p>
                    <p style="text-align: center;font-size:12px;">
                        Cell: 01316-986471
                    </p>

                    <p style="text-align: center;font-size:12px;">
                         invoice
                    </p>
                    
                    <hr>
                    @php
                        if($table->bill()->where('status', 1)->first()){
                            $orderId = $table->bill()->where('status', 1)->first()->bill_id;
                        }else{
                            $orderId = '';
                        }



                    @endphp
                    <h4>{{$table->name}}</h4>
                    <p  style="font-size: 11px;">Order Id : <span>{{$orderId}}</span></p>
                    <p  style="font-size: 11px;">Order Date : <span id="date1"></span></p>
                    <script> 
                        document.getElementById('date1').innerHTML = data.toLocaleDateString()+"--"+data.toLocaleTimeString()
                    </script>
                    <hr>
                    <div>
                        <!-- item start -->
                        <div>
                            <h2  style="text-align: center; font-size:16px;" >Order Info</h2>
                            <div style="display: flex; flex-wrap: wrap;  border-bottom: 1px solid black; margin-bottom:12px;">
                                <div style="flex: 0 0 50%;max-width: 50%;">
                                    <p style="font-size: 12px;">
                                        Item (rate * quantity)
                                    </p>
                                </div>
                                <div style="flex: 0 0 50%;max-width: 50%;">
                                    <p  style="font-size: 12px; text-align:right;">
                                       price
                                    </p>
                                </div>
                            </div>
                            <div style="display: flex;flex-wrap: wrap;">
                                @if($table->bill()->where('status', 1)->first())
                                    @foreach ($table->bill()->where('status', 1)->first()->order as $key => $order)
                                        
                                        <div style="flex: 0 0 50%;max-width: 50%;">
                                            <p style="font-size: 12px;">
                                               {{ $order->food_name}} ({{$order->price}} tk * {{$order->quantity}})
                                            </p>
                                        </div>
                                        <div style="flex: 0 0 50%;max-width: 50%;">
                                            <p style="font-size: 12px; text-align:right;">
                                            {{$order->total}} tk
                                            </p>
                                        </div>                                     
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <!-- item end -->
                    </div>
                    <div>
                        <hr>
                        <div style="display: flex; flex-wrap: wrap;">
                            <div style="flex: 0 0 50%;max-width: 50%;">
                                <p style="font-size: 12px;text-align:right;">
                                    Order Total :
                                </p>
                                <p style="font-size: 12px;text-align:right;">
                                    Vat :
                                </p>
                                <p style="font-size: 12px;text-align:right;">
                                    S. Charge :
                                </p>
                                <p style="font-size: 12px;text-align:right;">
                                    Discount :
                                </p>
                                <p style="font-size: 12px;text-align:right;">
                                    Payable :
                                </p>
                            </div>
                            <div style="flex: 0 0 50%;max-width: 50%;">
                                <p  style="font-size: 12px; text-align:right;">
                                   {{$table->bill()->where('status', 1)->first()->total}} tk
                                </p>
                                <p  style="font-size: 12px; text-align:right;">
                                    {{$table->bill()->where('status', 1)->first()->vat}} tk
                                 </p>
                                 <p  style="font-size: 12px; text-align:right;">
                                    {{$table->bill()->where('status', 1)->first()->service_charge}} tk
                                 </p>
                                 <p  style="font-size: 12px; text-align:right;">
                                    {{$table->bill()->where('status', 1)->first()->discount}} tk
                                 </p>
                                 <p  style="font-size: 12px; text-align:right;">
                                    {{$table->bill()->where('status', 1)->first()->payable}} tk
                                 </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <hr>
                        <div style="display: flex; flex-wrap: wrap;">
                            <div style="flex: 0 0 50%;max-width: 50%;">
                                <p style="font-size: 12px;text-align:right;">
                                    Cash :
                                </p>
                                <p style="font-size: 12px;text-align:right;">
                                    Bkash :
                                </p>
                                <p style="font-size: 12px;text-align:right;">
                                    Card :
                                </p>
                                <p style="font-size: 12px;text-align:right;">
                                    Total Paid :
                                </p>
                            </div>
                            <div style="flex: 0 0 50%;max-width: 50%;">
                                <p  style="font-size: 12px; text-align:right;">
                                   <span id="cashshow"></span> tk
                                </p>
                                <p  style="font-size: 12px; text-align:right;">
                                    <span id="bkashshow"></span> tk
                                 </p>
                                 <p  style="font-size: 12px; text-align:right;">
                                    <span id="cardshow"></span> tk
                                 </p>
                                 <p  style="font-size: 12px; text-align:right;">
                                    <span id="totalshow"></span> tk
                                 </p>
                                
                            </div>
                        </div>
                    </div>

                    <div>
                        <hr>
                        <p style="text-align: center;font-size:10px;border-bottom:1px solid black;">Thanks For Comming</p>
                    
                        <p style="text-align: center;font-size:9px;">Developed By: ssttechbd.com</p>
                    </div>
                    
                </div>
                
            </div>
        </div>
      </div>
    </div>
  </div>
  @endif

  {{-- end model for invoice --}}
        <!-- food item row start -->
        <section class="food-item-section">
            <div class="row">
                <!-- left part start -->
                <div class="col-md-8">
                    <div class="row title-row">
                        <div class="col-md-12">
                            <h1>choose food</h1>
                        </div>
                    </div>
                    <!-- filter item row start -->
                    <div class="row filter-item-row">
                        <div class="col-md-12">
                            <ul>
                                <li class="filter-item item-all active-item" id="item-all">all items</li>
                                @foreach ($categories as $category)
                                <li class="filter-item item-{{$category->cat_id}}"  id="item-{{$category->cat_id}}">{{$category->name}}</li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <!-- filter item row end -->
                    <div class="row filter-row active-row item-all">

                        @foreach ($categories as $category)

                            @foreach ($category->foods as $food)
                            
                                <!-- item start -->
                                <div class="col-md-5 my-5">
                                    <div class="filter-box">
                                        <div class="row">
                                            <div class="col-md-8 col-8">
                                                <div class="right">
                                                    <h2>{{$food->name}}</h2>
                                                    <p>Price : {{$food->price}} tk</p>
                                                    <ul>
                                                        <li>qty : </li>
                                                        <li>
                                                            <input type="number" value="1" min="1" class="quantity quantity-taker">
                                                        </li>
                                                        <li>
                                                            <i class="fas fa-plus add-qt" data-food="{{$food->food_id}}" data-name="{{$food->name}}"></i>

                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- item end -->

                            @endforeach

                        @endforeach
                        
                  
                    </div>


                    @foreach ($categories as $category)
                        <div class="row filter-row item-{{$category->cat_id}}">
                            
                            @foreach ($category->foods as $food)
                                <!-- item start -->
                                <div class="col-md-5 my-5">
                                    <div class="filter-box">
                                        <div class="row">
                                            <div class="col-md-8 col-8">
                                                <div class="right">
                                                    <h2>{{$food->name}}</h2>
                                                    <p>Price : {{$food->price}} tk</p>
                                                    <ul>
                                                        <li>qty : </li>
                                                        <li>
                                                            <input type="number" value="1" min="1" class="quantity quantity-taker">
                                                        </li>
                                                        <li>
                                                            <i class="fas fa-plus add-qt" data-food="{{$food->food_id}}" data-name="{{$food->name}}"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- item end -->
                            @endforeach

                        </div>
                    @endforeach
                </div>
                <!-- left part end -->
                <!-- right part start -->
                @if($table->status)
                <div class="col-md-4" id="qt">
                    <div class="order-summary">
                        <h1 class="text-center text-dark" style="text-align: center;">{{$table->name}}</h1>
                        
                        <p class="text-right border-right pr-1" style="font-size: 10px;text-align: right;border-right: 1px solid #dee2e6 !important;">KITCHEN PRINT : FOOD ITEM</p>
                        <hr>
                        @php
                            if($table->bill()->where('status', 1)->first()){
                                $orderId = $table->bill()->where('status', 1)->first()->bill_id;
                            }else{
                                $orderId = '';
                            }



                        @endphp
                        <p  style="font-size: 11px;">Order Id : <span id="order_id">{{$orderId}}</span></p>
                        <p  style="font-size: 11px;">Order Date : <span id="date"></span></p>
                        <script> 
                            document.getElementById('date').innerHTML = data.toLocaleDateString()+"--"+data.toLocaleTimeString()
                        </script>
                        <hr>
                        <div class="row">
                            <!-- item start -->
                            <div class="col-md-12">
                                <h2 class="text-center h5 border-bottom" style="text-align: center; font-size:16px;" >Order Info</h2>
                                <div class="row border-bottom mb-1" style="display: flex; flex-wrap: wrap;  border-bottom: 1px solid black;">
                                    <div class="col-6" style="flex: 0 0 50%;max-width: 50%;">
                                        <p style="font-size: 12px;">
                                            Item
                                        </p>
                                    </div>
                                    <div class="col-6" style="
                                    flex: 0 0 50%;
                                    max-width: 50%;
                                ">
                                        <p class="text-right" style="font-size: 12px; text-align:right;">
                                            QTY.
                                        </p>
                                    </div>
                                </div>
                                <div id="itemsss">

                                </div>
                            </div>
                            <!-- item end -->
                        </div>
                        
                    </div>
                    
                </div>
                @endif
                <!-- right part end -->
            </div>
        </section>
        @if($table->status)
        <div class="row print-button">
            <div class="col-md-12 text-right">
                <button id="printQt">print KOT</button>
            </div>
        </div>
        @endif
        <!-- food item row end -->
        <!-- page indicator start -->
        <section class="page-indicator">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li>
                            <i class="fas fa-bars"></i>
                        </li>
                        <li>
                            order list
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- page indicator end -->
        <!-- order list table start -->
        <section class="order-list">
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Item Name</td>
                                <td>Type</td>                                
                                <td>U. Price</td>
                                <td>Qty</td>
                                <td>Total</td>
                            </tr>
                        </thead>
                        <tbody>

                           
                           @if($table->bill()->where('status', 1)->first())
                                @foreach ($table->bill()->where('status', 1)->first()->order as $key => $order)
                                    
                                
                                    <tr>
                                        <th>{{$key + 1}}</th>
                                        <td>{{$order->food_name}}</td>
                                        <td>{{$order->type}}</td>
                                        <td>{{$order->price}}</td>
                                        <td>{{$order->quantity}}</td>
                                        <td>{{$order->total}}</td>
                                        
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- order list table end -->
    </div>
</div>
<!-- main content end -->

<script>
    const table = "{{$table->table_id}}"

</script>
@endsection