<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('News') }}
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

                    <div class="d-flex justify-content-between mb-4">

                        <a href="{{ route('news.create') }}"
                            class="btn btn-primary">
                            Create News
                        </a>


                        <form action="{{ route('news.index') }}" method="GET" class="d-flex">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search News..."
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


                    <div class="overflow-x-auto py-4">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>New Name</th>
                                    <th>Description</th>
                                    <th>Category Name</th>
                                    <th>Body</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($news->isEmpty())
                                <tr>
                                    <td colspan="5">No Data</td>
                                </tr>
                                @else
                                <?php $i = 0 ?>
                                @foreach($news as $new)
                                <?php $i++ ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $new->name }}</td>
                                        <td>{{ strip_tags($new->description) }}</td>
                                        <td>
                                            @forelse($new->categories as $category)
                                                <span>{{ $category->name }}</span>{{ !$loop->last ? ', ' : '' }}
                                            @empty
                                                <span>No Category</span>
                                            @endforelse
                                        </td>
                                        <td>{{ $new->body }}</td>
                                        <td>
                                            <a href="{{ route('news.edit', $new->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('news.destroy', $new->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
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

    <div class="mt-4">
        {{ $news->links() }}
    </div>
</x-app-layout>




