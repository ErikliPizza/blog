@props(['posts'])

<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>

    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <th scope="row">{{ $post->id }}</th>
            <td class="text-second"><a href="/posts/{{ $post->slug }}">{{ ucwords($post->title) }}</a></td>
            <td><a href="/dashboard/admin/{{ $post->id }}/edit" class="btn btn-sm btn-success">Edit</a></td>
            <td>
                <form method="POST" action="/dashboard/admin/{{ $post->id }}/edit">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
