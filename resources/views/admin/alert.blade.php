@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{-- Kiem tra neu ton tai mot bien session['error/succses'] thi hien thi thong bao --}}
@if(Session::has('error')) 
    <div class="alert alert-danger" style="text-align: center">
        {{ Session::get('error') }}
    </div>
@endif  

@if(Session::has('success')) 
    <div class="alert alert-success" style="text-align: center">
        {{ Session::get('success') }}
    </div>
@endif