<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit news') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8">

                <form action="{{ route('news.update', $news->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-lg font-medium text-gray-700 mb-2">news Name:</label>
                        <input type="text" name="name" id="name" value="{{ $news->name }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-lg font-medium text-gray-700 mb-2">Description</label>
                        <textarea id="description" name="description" rows="3" placeholder="content"
                                  class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">{{ $news->description }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="body" class="block text-lg font-medium text-gray-700 mb-2">Body</label>
                        <textarea id="body" name="body" rows="3" placeholder="content"
                                  class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">{{ $news->body }}</textarea>
                    </div>

                    <div>
                        <label for="category-selector">Categories</label>
                        <select name="category_id[]" id="category_id[]" multiple
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



    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#description', // يستهدف حقل النص بالمعرف "description"
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
        menubar: false,
        height: 300,
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
        branding: false // لإخفاء العلامة التجارية
    });
</script>
</x-app-layout>
