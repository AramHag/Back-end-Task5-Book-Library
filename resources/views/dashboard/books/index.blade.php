@extends('layouts.app')

@section('title', 'Books')

@section('content')

    <div>
        @include('layouts.sessions_messages')
    </div>
    <table class="table table-hover">
        <thead>
            <th>Book title</th>
            <th>Author</th>
            <th>Publish date</th>
            <th>Category</th>
            <th>Description</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publish_date }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>{{ $book->description }}</td>
                    <td>
                        <a href="{{ route('book.edit', ['book' => $book]) }}" class="btn btn-info" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
                        <form action="{{ route('book.delete', ['book' => $book]) }}" class="d-inline ml-1" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
