@extends('layouts.dashboard')

@section('pagetitle', 'create')

@section('content')
    {{-- @parent --}}
    <!-- Content Wrapper. Contains page content -->
    @can('create', 'App\Models\Role')
        <form action="{{ route('dashboard.roles.store') }}" method="post" class="px-3" enctype="multipart/form-data">
            @csrf
            @include('dashboard.roles._form', [
                'botton_label' => 'Create',
            ])

        </form>
    @endcan
    <!-- /.content-wrapper -->
@endsection
{{-- @yield('master') --}}
