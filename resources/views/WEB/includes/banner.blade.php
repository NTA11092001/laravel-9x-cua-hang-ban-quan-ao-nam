<div class="container-fluid" style="margin-bottom:20px">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            @for($i=1;$i<4;$i++)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$i}}" aria-label="Slide {{$i+1}}"></button>
            @endfor
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('img/banner-BF2021.png')}}" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/background-2.jpg')}}" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/background-3.jpg')}}" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/background.jpg')}}" class="d-block w-100">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
