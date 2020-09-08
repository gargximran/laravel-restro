<!-- left sidebar pc start -->
<section class="left-sidebar">
    <div class="container-fluid">
    
        <!-- top part start -->
        <div class="row top-part">

            <!-- middle part start -->
            <div class="col-md-7 col-7">
                <h3>{{Auth::user()->name}}</h3>
                <p style="font-size: 10px; color: rgb(194, 144, 144);">@if(Auth::user()->isAdmin) Admin @else User @endif</p>
            </div>
            <!-- middle part end --> 

            <!-- right part start -->
            <div class="col-md-2 col-2">
                <img src="{{ asset('asset/images/badge.png') }}" class="img-fluid" alt="">
            </div>
            <!-- right part end -->

        </div>
        <!-- top part end -->

        <!-- navbar item start -->
        <div class="row nav-item">
            <div class="col-md-12">
                <ul>
                    <li >
                        <a href="{{route('home')}}">
                           <div class="left">
                                dashboard
                           </div>
                           <div class="right">
                                <i class="fas fa-home"></i>
                           </div>
                        </a>
                    </li>
                    <li >
                        <a href="food-items.php">
                           <div class="left">
                                food item
                           </div>
                           <div class="right">
                                <i class="fas fa-crosshairs"></i>
                           </div>
                        </a>
                    </li>
                    
                    @if(Auth::user()->isAdmin == 1)
                        
                        <li >
                            <a href="">
                            <div class="left">
                                    report
                            </div>
                            <div class="right">
                                    <i class="fas fa-id-badge"></i>
                            </div>
                            </a>
                        </li>
                        <li >
                            <a href="{{ route('user') }}">
                            <div class="left">
                                    user
                            </div>
                            <div class="right">
                                    <i class="fas fa-user"></i>
                            </div>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- navbar item end -->

    </div>
</section>
<!-- left sidebar pc end -->