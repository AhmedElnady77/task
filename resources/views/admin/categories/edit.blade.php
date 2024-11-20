
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8">

                <form action="{{ route('categories.update', $Category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-lg font-medium text-gray-700 mb-2">Category Name:</label>
                        <input type="text" name="name" id="name" value="{{ $Category->name }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">

                    </div>
                    <div class="mb-6">
                        <label for="multi-selector" class="block text-lg font-medium text-gray-700 mb-2">Parent:</label>
                        <select id="categories" name="categories" multiple
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                            class="px-6 py-2 bg-green-500 text-black font-semibold rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


{{-- <h1>Edit News Category</h1>
<form action="{{ route('news-categories.update', $newsCategory->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Category Name:</label>
    <input type="text" name="name" value="{{ $newsCategory->name }}" required>
    <button type="submit">Update</button>
</form> --}}

