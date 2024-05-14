@extends('layouts.app')

@section('title', 'Add new User')

@section('content')
    @include('layouts.sessions_messages')

    <form action="{{ route('user.store') }}" method="POST" class="p-4">
        @csrf
        @include('dashboard.users.__form')
    </form>

    <script>
        $(document).ready(function() {
            $('.roles').select2();
        });
    </script>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.roles').select2();
        });
    </script>
@endsection
