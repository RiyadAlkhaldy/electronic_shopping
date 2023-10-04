@extends('layouts.dashboard')
 

{{--  @section('pagetitle', 'create')  --}}
@section('pagetitle','products')


@section('content')
<x-alert/>

    {{-- @parent --}}
    <!-- Content Wrapper. Contains page content -->
    <form action="{{ route('dashboard.products.update',$product->id) }}" method="post" class="px-3" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.products._form',[
            'botton_label'=>"Update"
        ])
    </form>
    <!-- /.content-wrapper -->
@endsection
{{-- @yield('master') --}}
