@extends('layouts.dashboard')

@section('pagetitle', 'Profile Edit')

@section('content')
<!-- Content Wrapper. Contains page content -->
<form action="{{ route('dashboard.profile.update') }}" method="post" class="px-3" enctype="multipart/form-data">
    @csrf
    @method('patch')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="form-row">
    <div class="col-md-6">
        <label for="first_name"> first Name </label>
        <x-form.input name="first_name" id="first_name" type="text" value="{{ $user->profile->first_name }}" />
    </div>
    <div class="col-md-6">
        <label for="last_name">Last name </label>
        <x-form.input name="last_name" id="last_name" type="text" value="{{ $user->profile->last_name }}" />
    </div>
</div>
<div class="form-row">

    <div class="col-md-6">
        <label for="birthday">birth day </label>
        <x-form.input lang="ltr" name="birthday" id="birthday" type="date" value="{{ $user->profile->birthday }}" />
    </div>
    <div class="col-md-6">
        <label for="gender">Gender</label>
        <x-form.radio name="gender" :checked="$user->profile->gender" :options="['male' => 'male', 'female' => 'Female']" />
    </div>
</div>

<div class="form-row">
    <div class="col-md-4">
        <label for="street_address">Street Address </label>
        <x-form.input name="street_address" id="street_address" type="text" value="{{ $user->profile->street_address }}" />
    </div>
    <div class="col-md-4">
        <label for="city">City</label>
        <x-form.input name="city" id="city" type="text" value="{{ $user->profile->city }}" />
    </div>
    <div class="col-md-4">
        <label for="state">State </label>
        <x-form.input name="state" id="state" type="text" value="{{ $user->profile->state }}" />
    </div>
</div>

<div class="form-row">
    <div class="col-md-4">
        <label for="postal_code">Postal Code </label>
        <x-form.input name="postal_code" id="postal_code" type="text" :value="$user->profile->postal_code" />
    </div>
    <div class="col-md-4">
        <label for="country">Country </label>
        <x-form.selected name="country" id="country"   :options="$countries" :selected="$user->profile->country" />
    </div>
    <div class="col-md-4">
        <label for="locale">Locale </label>
        <x-form.selected name="locale" id="locale"   :options="$locales" :selected="$user->profile->locale" />
    </div>
     

</div>
<button class="btn btn-primary">Save</button>

</form>
<!-- /.content-wrapper -->
@endsection
