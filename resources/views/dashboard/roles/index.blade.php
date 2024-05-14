@extends('layouts.app')

@section('title' , 'Roles')

@section('content')
    @include('layouts.sessions_messages')
    <?php $i = 1  ?>
    <table class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Role name</th>
            <th></th>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('role.edit', ['role' => $role]) }}" class="btn btn-info" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
                        <form action="{{ route('role.delete', ['role' => $role]) }}" class="d-inline ml-1" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>

                <?php $i++ ?>
            @empty
                
            @endforelse
        </tbody>
    </table>
@endsection