<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-center font-bold text-xl"><a href="/posts/{{ $post->slug }}">Edit: {{ $post->title }}</a></h1>
                    <form method="POST" action="/dashboard/admin/{{ $post->id }}/edit" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <x-form.input name="title" :value="old('title', $post->title)" />
                        <x-form.input name="slug" :value="old('slug', $post->slug)" />
                        <div class="d-flex">
                            <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)"/>
                            <img src="{{ asset('storage/' . $post->thumbnail) }}" style="max-height: 100px; max-width: 100px;">
                        </div>
                        <x-form.textarea name="excerpt" rows="3">{{ old('excerpt', $post->excerpt) }}</x-form.textarea>
                        <x-form.textarea name="body" rows="12">{{ old('body', $post->body) }}</x-form.textarea>

                        <div class="text-center">
                            <x-form.label name="category" />
                            <select name="category_id" id="category_id">
                                @foreach(\App\Models\Category::all() as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}
                                    >
                                        {{ ucwords($category->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary text-dark">UPDATE</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

