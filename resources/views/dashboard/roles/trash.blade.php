@extends('layouts.dashboard')

@section('pagetitle', 'Trashed Categories')
@section('create')

<div class="p-5">
    <a href="{{ route('dashboard.categories.index') }}" class="btn btn-sm btn-outline-primary">
        {{-- <i class="fas fa-back    "></i> --}}
        <i class="fa fa-backward "></i>
    </a>

</div>
@endsection

@section('content')

<x-alert />
<form class="d-flex justify-content-around mx-3 mb-4" action="{{ URL::current() }}" method="GET">
    <x-form.input name="name" id="name" style="width: 50%" :value="request('name')" />
    <div class="form-check">
        <input type="radio" name="status" value="" @checked(old('status', request('status'))=='' ) id="form-check-input" />
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
            <td>Status</td>
            <td>Image</td>
            <td>Delete At</td>
            <td>Restore</td>
            <td>Force Delete</td>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->parent_name }}</td>
            <td>{{ $category->status }}</td>
            <td><img src="{{ asset('uploads/' . $category->image) }}" alt="" height="100"></td>
            <td>{{ $category->deleted_at }}</td>
            <td>
                <form action="{{ route('dashboard.categories.restore', ['category' => $category]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_mehtode" value="delete">
                    @method('put')
                    <input type="submit" value="restore" class="btn btn-sm btn-outline-danger">

                </form>
            </td>
            <td>
                <form action="{{ route('dashboard.categories.force-delete', ['category' => $category]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_mehtode" value="delete">
                    @method('delete')
                    <input type="submit" value="Delete" class="btn btn-sm btn-outline-danger">
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8">no categories defined</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div style="width: 95% ">
    {{ $categories->withQueryString()->links() }}

</div>
@endsection
