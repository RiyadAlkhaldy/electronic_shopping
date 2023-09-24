@extends('layouts.dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endpush

{{--  @section('pagetitle', 'create')  --}}
@section('pagetitle','Categories Edit')


@section('content')
    {{-- @parent --}}
    <!-- Content Wrapper. Contains page content -->
    <form action="{{ route('dashboard.categories.update',$category->id) }}" method="post" class="px-3" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.categories._form',[
            'botton_label'=>"Update"
        ])
    </form>
    <!-- /.content-wrapper -->
@endsection
{{-- @yield('master') --}}
