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
                   
                </div>
                <div class="col-md-4 print-button">
                    <div class="text-center ">
                        <button class="bg-info"> guest bill</button>
                        <button class="invoice"> invoice</button>
                    </div>
                </div>
            </div>
        </section>
        <!-- page indicator end -->
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
                                                            <i class="fas fa-plus add-qt" data-food="{{$food->food_id}}"></i>
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
                                                            <i class="fas fa-plus add-qt" data-food="{{$food->food_id}}"></i>
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
                <div class="col-md-4" id="qt">
                    <div class="order-summary" style="width:340px;">
                        <h1 class="text-center text-dark" style="text-align: center;">{{$table->name}}</h1>
                        
                        <p class="text-right border-right pr-1" style="font-size: 10px;text-align: right;border-right: 1px solid #dee2e6 !important;">KITCHEN PRINT : FOOD ITEM</p>
                        <hr>
                        <p  style="font-size: 11px;">Order Id : <span id="order_id"></span></p>
                        <p  style="font-size: 11px;">Order Date : <span id="date"></span></p>
                        <script> 
                            document.getElementById('date').innerHTML = data
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
                                <div class="row itemss" style="  display: flex;
                                flex-wrap: wrap;;">
                                    <div class="col-6" style="
                                    flex: 0 0 50%;
                                    max-width: 50%;
                                ">
                                        <p style="font-size: 12px;">
                                            <span class="badge badge-dark cross" style="cursor: pointer;margin-right:5px;">(x)</span> Sluggy Burger
                                        </p>
                                    </div>

                                    <div class="col-6" style="
                                    flex: 0 0 50%;
                                    max-width: 50%;
                                ">
                                        <p class="text-right" style="font-size: 12px; text-align:right;">
                                            1
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- item end -->
                        </div>
                        
                    </div>
                    
                </div>
                <!-- right part end -->
            </div>
        </section>
        <div class="row print-button">
            <div class="col-md-12 text-right">
                <button>print qt</button>
            </div>
        </div>
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
                                <td>image</td>
                                <td>item name</td>
                                <td>type</td>
                                <td>category</td>
                                <td>price</td>
                                <td>action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>
                                    <img src="images/food.png" class="img-fluid" alt="">
                                </td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td class="action">
                                    <ul>
                                        <li class="edit">
                                            <i class="fas fa-edit"></i>
                                        </li>
                                        <li class="delete">
                                            <i class="fas fa-trash"></i>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
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