@extends('layout.app')

@section('body-content')
	<!-- main content start -->
<div class="main-content">
    <div class="container-fluid">


        <!-- page indicator start -->
        <section class="page-indicator">
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li>
                            <i class="fas fa-user"></i>
                        </li>
                        <li>
                            All Bill
                        </li>
                        <li>
                            <a href="{{route('today_report')}}"> Today Report</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <form action="{{route('pick_report')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">From</label>
                                    <input name="from" type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">To</label>
                                    <input name="to" type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button class="btn btn-primary">Get Bill</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                                <td>Date Time</td>
                                <td>Bill No.</td>
                                <td>Table Name</td>
                                <td>Total</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bills as $bill)                            
                            
                                <tr>
                                    <th>{{$bill->created_at->format('Y:m:d h:i:s A')}}</th>
                                    <td>{{$bill->bill_id}}</td>
                                    <td>{{$bill->table_name}}</td>
                                    <td>{{$bill->payable}}</td>
                                    <td class="action">
                                        <ul>
                                            <li class="delete">
                                                <i class="fas fa-trash" data-toggle="modal" data-target="#deletUser"></i>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>


                                <!--delete user Modal -->
                                <div class="modal fade" id="deletUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="exampleModalLabel">Delete User</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body add-table-form">
                                                <form action="" method="POST"> @csrf
                                                    @method('delete')

                                                    <div class="form-group text-right">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Yes</button>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                        </div>
                                           
                                    </div>
                                </div>


                            @endforeach
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