<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category Management') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-center font-bold text-xl">Add New Category</h1>
                    <form method="POST" action="/dashboard/admin/categories">
                        @csrf

                        <x-form.input name="name" />
                        <x-form.input name="slug" />

                        <div class="text-center">
                            <x-form.button>Add Category</x-form.button>
                        </div>
                    </form>
                    @if($categories->count())
                        <x-categories-grid :categories="$categories"/>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
