<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- Styles -->
    <style>
        /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */


        .content {
            margin: 150px auto;
            padding: 50px;
            box-shadow: 0px 0px 20px 0px rgb(174, 174, 174);
            border-radius: 5px;
        }


        .content .books-table tbody tr {}
    </style>
</head>

<body class="antialiased" style="background-color: rgb(252, 249, 238)">
    <div>
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary border-0 mt-3 fw-bold">Dashboard <i class="fa-solid fa-gear fa-lg p-2"></i></a>
                    <a href="{{ route('favorites', ['user_id' => Auth::user()->id]) }}" class="btn btn-outline-secondary border-0 mt-3 fw-bold">My Favorite <i class="fa-solid fa-star fa-lg p-2"></i></a>
                    <form action="{{ route('logout') }}" method="post" class="mx-3 d-inline">
                        @csrf

                        <button class="mt-3 btn btn btn-outline-danger border-0 fw-bold">Logout
                            <i class="right fa-solid fa-power-off p-2 fa-lg "></i></button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary border-0 fw-bold mt-3">Log
                        in<i class="fa-solid fa-arrow-right-to-bracket fa-lg p-2"></i></a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="btn mt-3 btn-outline-secondary border-0 fw-bold">Register <i class="fa-solid fa-user-plus fa-lg p-2"></i></a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
    <div class="container bg-white content">
        @include('layouts.sessions_messages')

        <div class="mb-5">
            <form action="{{ route('welcome') }}" method="GET">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-12 col-md-5 col-lg-5">
                        <label for="categories">Search by category</label>
                        <select name="category_id" class="form-control">
                            <option value="">All categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-12 col-md-5 col-lg-5">
                        <label for="main_category">Search main category</label>
                        <select name="main_category" class="form-control">
                            <option value="">All categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('main_category') == $category->id)>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-1">
                        <label for=""></label>
                        <button type="submit" class="btn btn-warning d-block">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <?php $i = 1; ?>
        @if (!Auth::user())
            <div>
                <h6 class="mb-5"><span class="text-warning fw-bold">Note:</span> register or log in if you have an
                    account to add books to your favorite and rate it.</h6>
            </div>
        @endif
        <table class="table table-hover books-table">
            <thead>
                <th>ID</th>
                <th>Book title</th>
                <th>Author</th>
                <th>Publish_date</th>
                <th>Category</th>
                <th>Main Category</th>
                <th>Description</th>
                <th></th>
            </thead>
            <tbody>
                @forelse    ($books as $book)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publish_date }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>{{ $book->category->parent->name ?? 'No Main Categroy' }}</td>
                        <td>{{ $book->description }}</td>
                        <td>
                            @auth
                                <form
                                    action="{{ route('addFavorite', ['user_id' => Auth::user()->id, 'book_id' => $book]) }}"
                                    method="get" class="d-inline">
                                    @csrf
                                    <button class="btn btn-outline-warning" title="Add to Favorites" type="submit">
                                        <i class="fa-solid fa-star"></i>
                                    </button>
                                </form>
                            @endauth
                        </td>
                    </tr>
                    <?php $i++; ?>
                @empty
                    <tr>
                        <td colspan="8" class="text-danger ">No books to show or there is no books belongs to search.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
