@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endpush

@section('pagetitle', 'create')

@section('content')
    {{-- @parent --}}
    <!-- Content Wrapper. Contains page content -->
    <form action="{{ route('dashboard.categories.store') }}" method="post" class="px-3" enctype="multipart/form-data">
        @csrf
         @include('dashboard.categories._form',[
            'botton_label'=>"Create"
        ])

    </form>
    <!-- /.content-wrapper -->
@endsection
{{-- @yield('master') --}}
