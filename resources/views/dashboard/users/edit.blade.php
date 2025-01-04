@extends('layouts.dashboard')


{{--  @section('pagetitle', 'create')  --}}
@section('pagetitle', 'User Edit')


@section('content')
    {{-- @parent --}}
    <!-- Content Wrapper. Contains page content -->
    <h1>User Edit</h1>
    @can('update', $user)
        <form action="{{ route('dashboard.users.update', [$user->id]) }}" method="post" class="px-3"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('dashboard.users._form', [
                'botton_label' => 'Update',
            ])
        </form>
    @endcan
    <!-- /.content-wrapper -->
@endsection
{{-- @yield('master') --}}
