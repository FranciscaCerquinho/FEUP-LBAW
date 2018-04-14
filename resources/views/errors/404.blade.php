@extends('layouts.app')

@section('content')
<div id="error">
    <div id="error_msg">
        <div class ="container">
            <div class ="row justify-content-md-center">
                <div class="col col-lg-1">
                    <h2 class="qOq">404</h2>
                </div>
                <div class="col">
                    <h2 class="pnf">Page not found</h2>
                </div>
            </div>
        </div>
        <p>The page you were looking for couldn't be found</p>
        <hr class="style17" style="color:grey;">
    </div>
    <div id="error_home">
        <button type="submit" onclick="window.location= '{{ route('auctions') }}'">Go to home page </button>
    </div>
</div>

@endsection