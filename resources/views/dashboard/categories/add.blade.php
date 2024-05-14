@extends('layouts.app')

@section('title', 'Add category')

@section('content')
    <div>
        @include('layouts.sessions_messages')
    </div>

    <form action="{{ route('category.store') }}" method="post">
        @csrf
        @include('dashboard.categories.__form')
    </form>
@endsection
