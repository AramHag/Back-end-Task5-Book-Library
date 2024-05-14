@extends('layouts.app')

@section('title', 'Edit book')

@section('content')
    <div>
        @include('layouts.sessions_messages')
    </div>

    <form action="{{ route('book.update', [ 'id' => $book->id]) }}" method="post">
        @csrf
        @method('PUT')
        @include('dashboard.books.__form')
    </form>
@endsection
