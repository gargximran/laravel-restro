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

        <!-- table item start -->
        <section class="all-table">
            <div class="row">
                @foreach ($tables as $table)
                    
                    
                <!-- item start -->
                <div class="col-md-3 " >
                    <a href="{{route('in_table', $table->table_id)}}">
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