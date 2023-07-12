@extends('components.layout')

@section('slot')
    <div class="container p-5">
        <div class="row">
            <div class="col-md-9">

                <article>
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }} cover image" class="img-fluid w-100">
                    <div class="p-1">
                        <ul class="list-inline">
                            <li class="list-inline-item font-inconsolata">
                                <i class="fa fa-user-circle-o"></i><a href="/?author={{ $post->author->name }}">  {{ $post->author->name }}</a>
                            </li>
                            <li class="list-inline-item font-inconsolata">
                                <i class="fa fa-calendar-o"></i> <time>{{ $post->created_at->diffForHumans() }}</time>
                            </li>
                            <li class="list-inline-item font-inconsolata">
                                <i class="fa fa-tags"></i> <a href="/?category={{ $post->category->slug }}">{{ $post->category->name }}</a>
                            </li>
                            @can('admin')
                                <li class="list-inline-item font-inconsolata">
                                    <i class="fa fa-pencil"></i> <a href="/dashboard/admin/{{ $post->id }}/edit">Edit</a>
                                </li>
                            @endcan
                        </ul>
                        <h3 class="font-georgia text-center">{{ ucwords($post->title) }}</h3>
                        <p class="font-inconsolata">
                            {!! $post->body !!}
                        </p>

                        <hr>
                        <div class="d-flex mb-1">
                            <a href="/author/{{ $post->author->username }}"><img class="d-flex mr-3 rounded-circle" width="75" src="{{ asset('storage/' . $post->author->avatar) }}" alt="Generic placeholder image"></a>
                                                            <a href="/author/{{ $post->author->username }}" class="font-georgia text-dark"><h5 class="mt-4">{{ ucwords($post->author->name) }}</h5></a>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <span class="font-georgia-pink">
                                    {{ $post->author->bio }}
                                </span>
                            </div>
                        </div>

                        <hr>
                        @if($post->comments->count())
                            <h4 class="font-georgia">COMMENTS</h4>
                            @foreach($post->comments as $comment)
                                <x-post-comment :comments="$comment" />
                            @endforeach
                        @endif

                        <hr>
                        @auth()
                        <h4 class="font-georgia">Post a comment</h4>
                        <form method="POST" action="/posts/{{ $post->slug }}/comments">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" rows="3" placeholder="It's me, hi, I'm the problem it's me." name="body"></textarea>
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @else
                        <p class="text-center text-secondary">Please <a href="/login">log in</a> to post a comment or <a href="/register">register now!</a> </p>
                        @endauth
                    </div>
                </article>
                <!-- post article-->

            </div>

            <div class="col-md-3">
                <div>
                    <h4 class="font-georgia p-1">Other Posts</h4>
                    <ul class="list-unstyled">
                        @foreach(\App\Models\Post::oldest()->take(3)->get() as $post)
                            <li class="media p-1">
                                <img class="d-flex mr-3 rounded" width="64" src="{{ asset('storage/' . $post->thumbnail) }}" alt="Generic placeholder image">
                                <div>
                                    <h5 class="mt-0 mb-1 font-inconsolata"><a href="/posts/{{ $post->slug }}">{{ Str::limit($post->title, 15) }}</a></h5> 
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection
