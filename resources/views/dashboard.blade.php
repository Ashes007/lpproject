This is user dashboard
<div> 
@if(auth()->guard()->check())
Hi,
{{ auth()->guard()->user()->name  }}
<a href="{{ URL::route('logout') }}">Logout</a>
@endif
</div>