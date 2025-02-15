@extends('layouts.dashboard')


{{--  @section('pagetitle', 'create')  --}}
@section('pagetitle', 'Roles Edit')


@section('content')
    {{-- @parent --}}
    <!-- Content Wrapper. Contains page content -->
    @can('update', $role)
        <form action="{{ route('dashboard.roles.update', $role->id) }}" method="post" class="px-3" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('dashboard.roles._form', [
                'botton_label' => 'Update',
            ])
        </form>
    @endcan

    <!-- /.content-wrapper -->
@endsection
{{-- @yield('master') --}}
