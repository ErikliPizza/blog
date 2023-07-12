<x-custom-dropdown>
    <x-slot:trigger>
        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Category' }}        </button>
    </x-slot:trigger>

    <x-custom-dropdown-item href="/?{{ http_build_query(request()->except('category', 'page')) }}"
                            :active="true">
        All
    </x-custom-dropdown-item>

    @foreach($categories as $category)
        <x-custom-dropdown-item
            href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}"
            :active="isset($currentCategory) && $currentCategory->is($category)"
        >{{ ucwords($category->name) }}
        </x-custom-dropdown-item>
    @endforeach
</x-custom-dropdown>

