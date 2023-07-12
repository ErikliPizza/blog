@props(['categories'])

<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">slug</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>

    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <form method="POST" action="/dashboard/admin/categories">
                @csrf
                @method('PATCH')
                <th scope="row">{{ $category->id }}</th>
                <td><input type="text" value="{{ $category->name }}" name="name"></td>
                <td><input type="text" value="{{ $category->slug }}" name="slug"></td>
                <td>
                    <input type="hidden" name="id" value="{{ $category->id }}" />
                    <button class="btn btn-sm btn-success">Update</button>
                </td>
            </form>
            <td>
                <form method="POST" action="/dashboard/admin/categories">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $category->id }}" />
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

