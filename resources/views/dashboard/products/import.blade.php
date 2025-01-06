@extends('layouts.dashboard')

@section('pagetitle', 'create')

@section('content')
    {{-- @parent --}}
    <!-- Content Wrapper. Contains page content -->
    <form action="{{ route('dashboard.products.import') }}" method="post" class="px-3" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
    <label for="name">Import Products   </label>
    <x-form.input name="count" id="count" type="number"   />
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Start Import ...</button>
    {{-- <a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary">Cancel</a> --}}
</div>
    </form>
    <!-- /.content-wrapper -->
@endsection
{{-- @yield('master') --}}
