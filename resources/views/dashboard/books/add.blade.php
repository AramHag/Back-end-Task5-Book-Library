@extends('layouts.app')

@section('title', 'Add book')

@section('content')
    <div>
        @include('layouts.sessions_messages')
    </div>

    <form action="{{ route('book.store') }}" method="post">
        @csrf
        @include('dashboard.books.__form')
    </form>
@endsection
