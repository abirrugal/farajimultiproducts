<div class="container-lg my-3 d-none d-lg-block">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Carousel indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for carousel items -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('allfiles/slider/first.jpg')}}" alt="First Slide">
            </div>
            <div class="carousel-item">
                <img src="{{asset('allfiles/slider/2nd.jpg')}}" alt="Second Slide">
            </div>
            <div class="carousel-item">
                <img src="{{asset('allfiles/slider/3rd.jpg')}}" alt="Third Slide">
            </div>
            <div class="carousel-item">
                <img src="{{asset('allfiles/slider/4rth.jpg')}}" alt="Third Slide">
            </div>
            <div class="carousel-item">
                <img src="{{asset('allfiles/slider/5th.jpg')}}" alt="Third Slide">
            </div>
        </div>
        <!-- Carousel controls -->
        <a class="carousel-control-prev text-dark text-decoration-none z-index-1000" href="#myCarousel" data-slide="prev">
            {{-- <span class="carousel-control-prev-icon text-dark"></span> --}}
            <i class="fas fa-chevron-left h2"></i>
        </a>
        <a class="carousel-control-next text-dark text-decoration-none z-index-1000" href="#myCarousel" data-slide="next">
            {{-- <span class="carousel-control-next-icon  "></span> --}}
            <i class="fas fa-chevron-right h2"></i>
        </a>
    </div>
</div>