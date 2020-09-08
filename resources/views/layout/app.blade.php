
@include('include.header')
@include('include.topbar')


<!-- body content start -->
<div class="body-content">


@include('include.leftsidebar')

@yield('body-content')

</div>

@include('include.script')

</body>
