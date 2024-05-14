@extends('layouts.app')

@section('title', 'Roles')

@section('content')
    @include('layouts.sessions_messages')
    <?php $i = 1; ?>
    <table class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Role name</th>
            <th></th>
        </thead>
        <tbody>
            @forelse ($trashed_roles as $role)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        {{-- <form action="{{ route('role.restore', ['role' => $role]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-success"><i class="fa-solid fa-arrow-up-from-bracket"></i></button>
                    </form> --}}
                        <a href="{{ route('role.restore', ['id' => $role->id]) }}" class="btn btn-success" title="Restore"><i class="fa-solid fa-arrow-up-from-bracket"></i></a>
                        <form action="{{ route('role.force_delete', ['id' => $role->id]) }}" class="d-inline ml-1" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" title="Force Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>

                <?php $i++; ?>
            @empty
            @endforelse
        </tbody>
    </table>
@endsection
