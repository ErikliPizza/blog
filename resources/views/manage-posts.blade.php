<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post Management') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-center font-bold text-xl">Add New Post</h1>
                    <form method="POST" action="/dashboard/admin/posts" enctype="multipart/form-data">
                        @csrf

                        <x-form.input name="title" required/>
                        <x-form.input name="slug" required/>
                        <x-form.input name="thumbnail" type="file" required/>
                        <x-form.textarea name="excerpt"/>
                        <x-form.textarea name="body"/>

                        <x-form.field>
                            <x-form.label name="category" />
                            <select class="form-control" name="category_id" id="category_id">
                                @foreach(\App\Models\Category::all() as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        {{ $category->id == old('category_id') ? 'selected' : '' }}
                                    >
                                        {{ ucwords($category->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </x-form.field>

                        <div class="text-center">
                            <x-form.button>Publish</x-form.button>
                        </div>


                    </form>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            @if($posts->count())
                <x-contents-grid :posts="$posts" />
            @endif
            {{ $posts->links() }}
        </div>


    </div>
</x-app-layout>
