<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($sliders as $slider)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" {{ $loop->index == 0 ? 'class=active' : ''}} ></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach($sliders as $slider)
            <div class="carousel-item {{ $loop->index == 0 ? 'active' : ''}}">
                @if($slider->link != null)
                <a href="{{ $slider->link }}">
                <img class="d-block w-100 rounded" src="{{ asset('storage/' . $slider->image) }}">
                </a>
                @else
                <img class="d-block w-100 rounded" src="{{ asset('storage/' . $slider->image) }}">
                @endif
                <div class="carousel-caption d-none d-md-block">
                    @if($slider->link != null)
                        <a href="{{ $slider->link }}">
                            <h5>{!! $slider->title !!}</h5>
                        </a>
                    @else
                        <h5>{!! $slider->title !!}</h5>
                    @endif
                    <p>{!! $slider->excerpt !!}</p>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
