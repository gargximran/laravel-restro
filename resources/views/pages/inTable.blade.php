@extends('layout.app')

@section('body-content')
<!-- main content start -->
<div class="main-content">
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
                                <li class="filter-item item-{{$category->cat_id}}"  id="item-{{$category->cat_id}}" >{{$category->name}}</li>
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
                                                            <input type="number" value="1" min="1" class="quantity">
                                                        </li>
                                                        <li>
                                                            <i class="fas fa-plus"></i>
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
                                                            <input type="number" value="1" min="1" class="quantity">
                                                        </li>
                                                        <li>
                                                            <i class="fas fa-plus"></i>
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
                <div class="col-md-4">
                    <div class="order-summary">
                        <h1 class="text-center">order summary</h1>
                        <div class="row">
                            <!-- item start -->
                            <div class="col-md-12">
                                <div class="filter-box">
                                    <div class="row">
                                        <div class="col-md-4 col-4">
                                            <img src="images/food.png" class="img-fluid" alt="">
                                        </div>
                                        <div class="col-md-8 col-8">
                                            <div class="right">
                                                <h3>Bio Musli With Peach</h3>
                                                <ul>
                                                    <li>qty : </li>
                                                    <li>
                                                        2
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- item end -->
                        </div>
                        <div class="row print-button">
                            <div class="col-md-12 text-center">
                                <button>print qt</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- right part end -->
            </div>
        </section>
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

@endsection