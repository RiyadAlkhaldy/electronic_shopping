@props([
'name','id'=>'','parent_id','parents'
])

<select name="{{ $name }}" id="{{ $id }}" class="form-select">
    <option value=""   > select value </option>

    @foreach ($parents as $parent)
        <option value="{{ $parent->id }}"
             @selected(old($name,$parent_id) == $parent->id)> {{ $parent->name }}</option>
    @endforeach
    @error($name)
    <div  class="text-red-600">{{ $message }}</div>
    @enderror
</select>
