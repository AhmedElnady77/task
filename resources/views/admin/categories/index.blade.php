<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    @include('session')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Header Row -->
                    <div class="d-flex justify-content-between mb-4">
                        <!-- زر إنشاء الفئة -->
                        <a href="{{ route('categories.create') }}"
                            class="btn btn-primary">
                            Create Category
                        </a>

                        <!-- نموذج البحث -->
                        <form action="{{ route('categories.index') }}" method="GET" class="d-flex">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search Categories..."
                                class="form-control me-2"
                            />
                            <button
                                type="submit"
                                class="btn btn-secondary"
                            >
                                Search
                            </button>
                        </form>
                    </div>

                    <!-- جدول الفئات -->
                    <div class="overflow-x-auto py-4 ">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Parent Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($categories->isEmpty())
                                <tr>
                                    <td colspan="4">No Data</td>
                                </tr>
                                @else
                                <?php $i = 0 ?>
                                @foreach($categories as $category)
                                <?php $i++ ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            {{ $category->parent ? $category->parent->name : '-' }}
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('categories.edit', $category->id) }}"
                                                   class="btn btn-warning btn-sm me-2">
                                                    Edit
                                                </a>

                                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-danger btn-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- روابط الصفحات -->
    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</x-app-layout>
