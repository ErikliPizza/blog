@props(['comments'])

<div class="d-flex mb-1">
    <a href="/author/{{ $comments->author->username }}"><img class="d-flex mr-3 rounded-circle" width="60" height="60" src="{{ asset('storage/' . $comments->author->avatar) }}" alt="Generic placeholder image"></a>
            <h5 class="mt-3">
            <a href="/author/{{ $comments->author->username }}" class="text-secondary">{{ ucwords($comments->author->name) }}</a>
        </h5>
        </div>
    <div class="media-body ml-1">
        <span class="font-inconsolata">
            <i class="fa-solid fa-quote-left"></i> {{ $comments->body }}
        </span>
    </div>
    @auth()
        @if(auth()->user()->id == $comments->user_id)
            <form method="POST" action="/posts/comments/delete">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="{{ $comments->id }}">
                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
            </form>
        @endif
    @endauth


</div>
