<section class="topbar-pc">
    <div class="container-fluid">
        <div class="row">

            <!-- logo start -->
            <div class="col-md-3 col-4">
                <div class="logo">
                    <img src="{{ asset('asset/images/logo.png')}}" class="img-fluid" alt="">                
                </div>            
            </div>
            <!-- logo end -->

            <!-- bar start -->
            <div class="col-1 for-mob">
                <i class="fas fa-bars show-nav"></i>
                <i class="fas fa-times hide-nav"></i>
            </div>
            <!-- bar end -->

            <!-- my profile start -->
            <div class="col-md-8 col-7">
                <div class="my-profile">
                    <ul>
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off text-danger" title="Logout"></i>
                            </a>


                        </li>
                    </ul>


                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>            
            </div>
            <!-- my profile end -->

        </div>
    </div>
</section>


