<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Slider Management') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-center font-bold text-xl">Add New Slider</h1>
                    <form method="POST" action="/dashboard/admin/sliders" enctype="multipart/form-data">
                        @csrf

                        <x-form.input name="title" />
                        <x-form.input name="excerpt" />
                        <x-form.input name="link" />
                        <x-form.input name="image" type="file" required/>

                        <div class="text-center">
                            <x-form.button>Add Slider</x-form.button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="container mt-5">
            @if($sliders->count())
                <x-sliders-grid :sliders="$sliders" />
            @endif
        </div>
    </div>
</x-app-layout>
