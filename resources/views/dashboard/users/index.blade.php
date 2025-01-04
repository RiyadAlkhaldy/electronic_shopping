@extends('layouts.dashboard')

@section('pagetitle', 'Users')
@section('create')

    <div class="p-5">
        @if (Auth::user()->can('users.create'))
            <a href="{{ route('dashboard.users.create') }}" class="btn btn-sm btn-outline-primary mr-2">
                Create
            </a>
        @endif
    </div>
@endsection

@section('content')

    <x-alert />
    <form class="d-flex justify-content-around mx-3 mb-4" action="{{ URL::current() }}" method="GET">
        <x-form.input name="name" id="name" style="width: 50%" :value="request('name')" />
        <div class="form-check">
            <input type="radio" name="status" value="" @checked(old('status', request('status')) == '') id="form-check-input" />
            <label for="form-check-input" class="form-check-label">All</label>
        </div>

        <x-form.radio name="status" :checked="request('status')" :options="['active' => 'Active', 'inactive' => 'Inactive']" />

        <submit class="btn btn-dark">Filter</submit>
    </form>
    <table class="table">
        <thead>
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Image</td>
                <td>Created At</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        @can('view', $user)
                            <a href="{{ route('dashboard.users.show', $user->id) }}">{{ $user->name }}</a>
                        @else
                            {{ $user->name }}
                        @endcan
                    </td>
                    {{--  <td><img src="{{ asset('uploads/'.$user->image) }}" alt="" height="100"></td>  --}}
                    <td><img src="{{ $user->image }}" alt="" width="150" height="100" /></td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        @can('update', $user)
                            <a href="{{ route('dashboard.users.edit', ['user' => $user]) }}"> Edit</a>
                        @endcan
                    </td>
                    <td>
                        @can('delete', $user)
                            <form action="{{ route('dashboard.users.destroy', ['user' => $user]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_mehtode" value="delete">
                                @method('delete')
                                <input type="submit" value="Delete" class="btn btn-sm btn-outline-danger">
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">no Products defined</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div style="width: 95% ">
        {{ $users->withQueryString()->links() }}

    </div>
@endsection
