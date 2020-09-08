@extends('layout.app')

@section('body-content')
	<!-- main content start -->
<div class="main-content">
    <div class="container-fluid">
        
        <!-- page indicator start -->
        <section class="page-indicator">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li>
                            <i class="fas fa-home"></i>
                        </li>
                        <li>
                            dashboard
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- page indicator end -->
        @if (Auth::user()->isAdmin)
        <!-- add title row start -->
        <section class="add-row">

            
            <div class="row">

               
                <div class="col-md-12">

                    
                        
                    
                    <!-- Button trigger modal -->
                    <button type="button" class="btn add-table" data-toggle="modal" data-target="#exampleModal">
                    Add Table +
                    </button>

                    

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Add Table</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body add-table-form">
                                <form action="{{route('add_table')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Table Name</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success">add</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn add-table" data-dismiss="modal">close</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- add title row end -->
        @endif

        <!-- table item start -->
        <section class="all-table">
            <div class="row">
                @foreach ($tables as $table)
                    
                    
                <!-- item start -->
                <div class="col-md-3 " >
                    <a href="">
                        <div class="table-item" @if ($table->status) style="background-image: url({{ asset('asset/images/table-blue.png') }})" @else  style="background-image: url({{ asset('asset/images/table-green.png') }})" @endif >
                            <div class="table-content">
                                <h2>{{$table->name}}</h2>
                                @if ($table->status)
                                <p class="text-occupied">occupied</p>
                                @else
                                <p class="text-available">available</p>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                <!-- item end -->
                @endforeach
             

            </div>
        </section>
        <!-- table item end -->

        

    </div>
</div>
<!-- main content end -->
@endsection