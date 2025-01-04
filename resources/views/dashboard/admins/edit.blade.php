@extends('layouts.dashboard')


{{--  @section('pagetitle', 'create')  --}}
@section('pagetitle', 'Admin Edit')


@section('content')
    {{-- @parent --}}
    <!-- Content Wrapper. Contains page content -->
    @can('update', $admin)
        <form action="{{ route('dashboard.admins.update', [$admin->id]) }}" method="post" class="px-3"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('dashboard.admins._form', [
                'botton_label' => 'Update',
            ])
        </form>
    @endcan
    <!-- /.content-wrapper -->
@endsection
{{-- @yield('master') --}}
