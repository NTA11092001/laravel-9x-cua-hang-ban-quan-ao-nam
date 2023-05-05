@if(session('some_error'))
    <div class="alert alert-danger">
        <p class="text-center text-danger">{{session('some_error')}}</p>
    </div>
@elseif ($errors->any())
    <div class="alert alert-danger d-flex justify-content-center align-content-center">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
