<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">Ads Board</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        @if(\Auth::guest())
            <a class="btn btn-outline-primary" href="{{ url('user/create') }}">Register</a>
            <a class="btn btn-outline-primary" href="{{ url('/login') }}">Sign In</a>
        @else
            <a class="p-2 text-dark" href="#">Welcome, {{ \Auth::user()->name }}</a>
            <a class="p-2 text-dark" href="{{ route('user.edit', \Auth::user()->id) }}">Profile</a>
            <a class="btn btn-outline-primary" href="{{ url('/logout') }}">Sign Out</a>
        @endif
    </nav>

</div>