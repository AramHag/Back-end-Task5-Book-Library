@extends('layouts.app')

@section('title', 'Edit category')

@section('content')
    <div>
        @include('layouts.sessions_messages')
    </div>

    <form action="{{ route('category.update', ['category' => $category]) }}" method="post">
        @csrf
        @method('put')
        @include('dashboard.categories.__form')
    </form>
@endsection
