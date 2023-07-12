@props(['post'])

<div class="col-md-4">
    <div class="card mb-4 box-shadow">
        <a href="/posts/{{ $post->slug }}">
            <img class="card-img-top" alt="{{ $post->title }} thumbnail" src="{{ asset('storage/' . $post->thumbnail) }}" style="height: 225px; width: 100%; display: block;">
        </a>
        <div class="card-body">
            <p class="card-text font-inconsolata">{{ Str::limit($post->excerpt, 80) }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="/posts/{{ $post->slug }}" type="button" class="btn btn-sm btn-warning">View</a>
                    @can('admin')
                    <a href="/dashboard/admin/{{ $post->id }}/edit" type="button" class="btn btn-sm btn-outline-success">Edit</a>
                    @endcan
                </div>
                <small class="text-muted"><time>{{ $post->created_at->diffForHumans() }}</time></small>
            </div>
        </div>
    </div>
</div>
