@extends('layouts.app')

@section('title', 'Add new user')

@section('content')
@include('layouts.sessions_messages')

    <form action="{{ route('role.store') }}" method="post">
        @csrf
        @include('dashboard.roles.__form')
    </form>
    
@endsection
