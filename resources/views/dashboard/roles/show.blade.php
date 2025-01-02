@extends('layouts.dashboard')


{{--  @section('pagetitle', 'create')  --}}
@section('pagetitle', "$role->name")


@section('content')
    <table class="table">
        <thead>
            <tr>
                <td>Id</td>
                <td>name</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        @php
            $products = $role
                ->products()
                ->with('store')
                ->orderBy('name')
                ->paginate(2);
        @endphp
        <tbody>
            @forelse($products  as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        <a href="{{ route('dashboard.products.edit', ['product' => $product]) }}"> Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.products.destroy', ['product' => $product]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="_mehtode" value="delete">
                            @method('delete')
                            <input type="submit" value="Delete" class="btn btn-sm btn-outline-danger">

                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">no Products defined</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div  style="width: 95% "  >
        {{$products->withQueryString()->links()}}
    
    </div>

@endsection
{{-- @yield('master') --}}
