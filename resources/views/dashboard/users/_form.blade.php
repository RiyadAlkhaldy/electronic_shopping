@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group">
    <label for="name">The Name </label>
    <x-form.input name="name" id="name" type="text" value="{{ $user->name }}" />
</div>
<div class="form-group">
    <label for="email">Email </label>
    <x-form.input name="email" id="email" type="email" value="{{ $user->email }}" />
</div>
<h2 class="m-3" style="font-weight: bold; font-size: 20px">{{ __('Roles') }}</h2>

@forelse ($roles as $role)
    <div class="form-group">
        <input type="checkbox" name="roles[]" id="" @checked(isset($user_roles)&& in_array($role->id, $user_roles)) value="{{ $role->id }}">
        <label for="name">
            <a href="{{ route('dashboard.roles.edit', $role) }}">{{ $role->name }}</a>
        </label>
    </div>
@empty
    <p> no Roles defined </p>
@endforelse
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $botton_label ?? 'Save' }}</button>
</div>
