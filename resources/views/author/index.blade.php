@extends('components.layout')

@section('slot')
    <main role="main">
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-md-9 col-lg-7 col-xl-5">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-4">
                                <div class="d-flex text-black">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('storage/' . $user->avatar) }}"
                                             alt="Profile Photo" class="img-fluid"
                                             style="width: 180px; border-radius: 10px;">
                                    </div>
                                    <div class="flex-grow-1 ml-3">
                                        <h5 class="mb-1 font-georgia">{{ ucwords($user->name) }}</h5>
                                        <p class="mb-2 pb-1 font-georgia-pink">{{ $user->username }}</p>
                                        <div class="d-flex justify-content-start rounded-3 p-2 mb-2">
                                            <div>
                                                <p class="small text-muted font-inconsolata">Comments: <span class="text-danger font-georgia">{{ $user->comment->count() }}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="font-georgia-pink border border-2 p-2 mt-1 rounded">{{ $user->bio }}</span>
                </div>
                <div class="mt-2">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">post</th>
                            <th scope="col">comment</th>
                            <th scope="col">date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->comment as $comment)
                            <tr>
                                <td><a href="/posts/{{ $comment->post->slug }}" class="font-georgia">{{ $comment->post->title }}</a></td>
                                <td class="font-inconsolata">{{ Str::limit($comment->body, 20) }}</td>
                                <td><time class="text-secondary font-inconsolata">{{ $comment->created_at->diffForHumans() }}</time></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
@endsection
