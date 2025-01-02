@extends('layouts.dashboard')

@section('pagetitle', 'Roles')
@section('create')

    <div class="p-5">
            <a href="{{ route('dashboard.roles.create') }}" class="btn btn-sm btn-outline-primary mr-2">
                Create
            </a>
    </div>
@endsection

@section('content')

    <x-alert />
    <table class="table">
        <thead>
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td><a href="{{ route('dashboard.roles.show', $role->id) }}">{{ $role->name }}</a></td>
                    {{-- @can('roles.update') --}}
                        <td>
                            <a href="{{ route('dashboard.roles.edit', ['role' => $role]) }}"> Edit</a>
                        </td>
                    {{-- @endcan --}}
                    @can('roles.delete')
                        <td>
                            <form action="{{ route('dashboard.roles.destroy', ['role' => $role]) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="_mehtode" value="delete">
                                @method('delete')
                                <input type="submit" value="Delete" class="btn btn-sm btn-outline-danger">

                            </form>
                        </td>
                    @endcan
                </tr>
            @empty
                <tr>
                    <td colspan="4">no Products defined</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div style="width: 95% ">
        {{ $roles->withQueryString()->links() }}

    </div>
@endsection
