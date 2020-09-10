
@include('include.header')
@include('include.topbar')


<!-- body content start -->
<div class="body-content">

@if (Auth::user()->isAdmin)
	@include('include.leftsidebar')
@endif



@yield('body-content')

</div>

@include('include.script')

</body>
