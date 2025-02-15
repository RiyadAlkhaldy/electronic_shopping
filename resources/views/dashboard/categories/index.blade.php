@extends('layouts.dashboard')

@section('pagetitle', 'Categories')
@section('create')

    <div class="p-5">
        @if (Auth::user()->can('categories.create'))
            <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary mr-2">
                Create
            </a>
        @endif
        <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-sm btn-outline-primary">
            Trash
        </a>
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
                <td>Parent name</td>
                <td>Products count</td>
                <td>Status</td>
                <td>Image</td>
                <td>Created At</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td><a href="{{ route('dashboard.categories.show', $category->id) }}">{{ $category->name }}</a></td>
                    <td>{{ $category->parent->name }}</td>
                    <td>{{ $category->products_count }}</td>
                    <td>{{ $category->status }}</td>
                    {{--  <td><img src="{{ asset('uploads/'.$category->image) }}" alt="" height="100"></td>  --}}
                    <td><img src="{{ $category->image }}" alt="" width="150" height="100" /></td>
                    <td>{{ $category->created_at }}</td>
                    @can('categories.update')
                        <td>
                            <a href="{{ route('dashboard.categories.edit', ['category' => $category]) }}"> Edit</a>
                        </td>
                    @endcan
                    @can('categories.delete')
                        <td>
                            <form action="{{ route('dashboard.categories.destroy', ['category' => $category]) }}"
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
                    <td colspan="9">no Products defined</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div style="width: 95% ">
        {{ $categories->withQueryString()->links() }}

    </div>
@endsection
