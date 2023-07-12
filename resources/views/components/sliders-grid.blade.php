@props(['sliders'])

<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">title</th>
        <th scope="col">excerpt</th>
        <th scope="col">link</th>
        <th scope="col">image</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sliders as $slider)
        <tr>
            <form method="POST" action="/dashboard/admin/sliders/{{ $slider->id }}/edit" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <th scope="row">{{ $slider->id }}</th>
                <td><input type="text" value="{{ $slider->title }}" name="title"></td>
                <td><input type="text" value="{{ $slider->excerpt }}" name="excerpt"></td>
                <td><input type="text" value="{{ $slider->link }}" name="link"></td>
                <td class="d-flex">
                    <input type="file" name="image" value="{{  old('image', $slider->image) }}">
                    <img src="{{ asset('storage/' . $slider->image) }}" style="max-height: 40px; max-width: 40px;">
                </td>
                <td>
                    <input type="hidden" name="id" value="{{ $slider->id }}" />
                    <button class="btn btn-sm btn-success">Update</button>
                </td>
            </form>
            <td>
                <form method="POST" action="/dashboard/admin/sliders/{{ $slider->id }}/edit">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $slider->id }}" />
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

