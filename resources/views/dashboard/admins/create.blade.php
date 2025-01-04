@extends('layouts.dashboard')

@section('pagetitle', 'Create Admin')

@section('content')
    {{-- @parent --}}
    <!-- Content Wrapper. Contains page content -->
    @can('create', 'App\Models\Admin')
        <form action="{{ route('dashboard.admins.store') }}" method="post" class="px-3" enctype="multipart/form-data">
            @csrf
            @include('dashboard.admins._form', [
                'botton_label' => 'Create',
            ])

        </form>
    @endcan
    <!-- /.content-wrapper -->
@endsection
{{-- @yield('master') --}}
