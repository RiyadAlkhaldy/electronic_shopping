<div class="form-group">
    <label for="name">Role name </label>
    <x-form.input lable="role name" class="form-control-lg" name="name" id="name" type="text" :value="$role->name" />
</div>
<fieldset>
    <legend>{{ __('Abilities') }}</legend>
    @foreach (config('abilities') as $ability_code => $ability_name)
        <div class="row mt-2" >
            <div class="col-md-6">
                {{ $ability_name }}
            </div>
            <div class="col-md-2">
                <input type="radio" name="abilities[{{ $ability_code }}]" value="allow" @checked(($role_abilities[$ability_code] ?? '') == 'allow')>
                allow
            </div>
            <div class="col-md-2">
                <input type="radio" name="abilities[{{ $ability_code }}]" value="deny" @checked(($role_abilities[$ability_code] ?? '') == 'deny')>
                deny
            </div>
            <div class="col-md-2">
                <input type="radio" name="abilities[{{ $ability_code }}]" value="inherit"
                    @checked(($role_abilities[$ability_code] ?? '') == 'inherit')> inherit
            </div>
        </div>
    @endforeach


    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ $botton_label ?? 'Save' }}</button>
    </div>
