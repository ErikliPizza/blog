@extends('components.layout')

@section('slot')
    <main role="main">

        <section class="container mt-2 text-center">
            <div class="container">
                <x-carousel-slider/>
                <p>
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">
                            <div class="row">
                                <div class="col">
                                    <x-category-dropdown/>
                                </div>
                                <div class="col">
                                    <form method="GET" action="/">

                                        @if(request('category'))
                                            <input type="hidden" name="category" value="{{ request('category') }}">
                                        @endif
                                        <input type="text" name="search" placeholder="Search"
                                               class="form-control"
                                               value="{{request('search')}}">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </p>
            </div>
        </section>
        <div class="album py-3">
            <div class="container">
                <div class="row">
                    @if(!request('category') && !request('search'))
                    <x-player />
                    @endif
                    @if($posts->count())
                        @foreach($posts as $post)
                            <x-post-grid :post="$post"/>
                        @endforeach
                    @endif
                </div>
                {{ $posts->links() }}
            </div>
        </div>

    </main>
@endsection
