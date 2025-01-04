@extends('layouts.dashboard')

@section('pagetitle', 'create User')

@section('content')
    {{-- @parent --}}
    <!-- Content Wrapper. Contains page content -->
    @ؤcan('create', 'App\Models\User')
    <form action="{{ route('dashboard.users.store') }}" method="post" class="px-3" enctype="multipart/form-data">
        @csrf
        @include('dashboard.users._form', [
            'botton_label' => 'Create',
        ])

    </form>
@endcan
<!-- /.content-wrapper -->
@endsection
{{-- @yield('master') --}}
