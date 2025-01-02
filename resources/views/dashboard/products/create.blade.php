@extends('layouts.dashboard')

@section('pagetitle', 'create')

@section('content')
    {{-- @parent --}}
    <!-- Content Wrapper. Contains page content -->
    <form action="{{ route('dashboard.products.store') }}" method="post" class="px-3" enctype="multipart/form-data">
        @csrf
         @include('dashboard.products._form',[
            'botton_label'=>"Create"
        ])

    </form>
    <!-- /.content-wrapper -->
@endsection
{{-- @yield('master') --}}
