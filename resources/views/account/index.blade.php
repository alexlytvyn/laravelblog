<h2>Welcome to the Site, {{\Auth::user()->email}}!</h2>
<br>
@if (\Auth::user()->isAdmin == 1)
	<a href="{{route('admin')}}">Admin Page</a>
	<br>
@endif
<a href="{{route('logout')}}">Logout</a>
