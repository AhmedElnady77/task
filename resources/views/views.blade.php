<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>News Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  </head>
  <body>
    <header class="bg-blue-600 text-white p-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto">

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('home.page')}}">Home</a>
                          </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($categories as $category)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('view.news', ['id' => $category->id]) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                    <form method="POST" action="{{ route('logout') }}" class="d-flex">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-3">
        @include('session')
    </div>


    <div class="container mt-2">

        <h1 class="text-center mb-4 text-primary">{{ $cat->name }}</h1>

        @if($cat->children->isNotEmpty())
        <div class="card text-center mb-5">
            <h4>Subcategories</h4>
            <ul class="list-inline mt-3">
                @foreach($cat->children as $child)
                    <li class="list-inline-item">
                        <a href="{{ route('view.news', ['id' => $child->id]) }}" class="btn btn-secondary btn-sm">
                            {{ $child->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
        @if($n_news->isEmpty())
            <p class="text-center text-muted mb-5">No news available in this category.</p>
        @else
            <div class="row g-4 mb-5"> 
                @foreach($n_news as $news)
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-dark">{{ $news->name }}</h5>
                                <p class="card-text text-secondary">{{ Str::limit(strip_tags($news->description), 150) }}</p>
                                <a href="{{ route('news.show',  ['id' => $news->id]) }}" class="btn btn-primary mt-auto">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $n_news->links() }}
            </div>
        @endif
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>











