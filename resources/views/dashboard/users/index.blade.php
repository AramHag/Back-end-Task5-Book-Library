@extends('layouts.app')

@section('title', 'Users')

@section('content')

    @include('layouts.sessions_messages')

    <div class="mb-3">
        <a href="{{ route('user.add') }}" class="btn btn-primary"> Add user</a>
    </div>

    <?php $i = 1; ?>
    <table class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th></th>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            {{ $role->name . " /" }}
                        @endforeach
                    </td>
                    <td>
                        <form action="{{ route('user.delete', ['id' => $user->id]) }}" method="POST" class="d-inline ml-1">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>

                <?php $i++; ?>
            @empty
            @endforelse
        </tbody>
    </table>
@endsection
