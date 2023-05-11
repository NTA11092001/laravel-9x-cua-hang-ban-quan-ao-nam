@if(session('some_error'))
    <div class="alert alert-danger bg-danger d-flex justify-content-center align-content-center h-auto pt-2 mb-3">
        <p class="text-center text-white">{{session('some_error')}}</p>
    </div>
@elseif ($errors->any())
    <div class="alert alert-danger d-flex justify-content-center align-content-center bg-danger h-auto mb-3">
        <ul class="pt-2 text-white">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
