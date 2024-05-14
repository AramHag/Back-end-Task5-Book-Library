@extends('layouts.app')

@section('title', 'Categories')

@section('content')

    <div>
        @include('layouts.sessions_messages')
    </div>
    <table class="table table-hover">
        <thead>
            <th>Category name</th>
            <th>Parent category</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent->name ?? '- Main Category -' }}</td>
                    <td>
                        <a href="{{ route('category.edit', ['category' => $category]) }}" class="btn btn-info" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
                        <form action="{{ route('category.delete', ['category' => $category]) }}" class="d-inline ml-1" method="POST">
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
