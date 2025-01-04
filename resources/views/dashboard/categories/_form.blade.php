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
    <label for="name">Category name </label>
 <x-form.input name="name" id="name" type="text" value="{{$category->name}}"  
   />
</div>

<div class="form-group">
    <label for="parent_id"> Category Parent</label>
    <x-form.select name="parent_id" :parents="$parents" :parent_id="$category->parent_id" id="parent_id"   />
    {{--  <select name="parent_id" id="parent_id" class="form-select">
        <option value=""   > select value </option>

        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id',$category->parent_id) == $parent->id)> {{ $parent->name }}</option>
        @endforeach
        @error('parent_id')
        <div  class="text-red-600">{{ $message }}</div>
        @enderror
    </select>  --}}
</div>
<x-form.textarea  name="description" id="Description" :value="$category->description" label="Description" />

{{--  <div class="form-group">
    <label for="Descriptione">Description Category</label>
    <textarea name="description" id="Description" class="form-control">{{ old('description',$category->description)??'' }}</textarea>
    @error('description')
        <div  class="text-red-600">{{ $message }}</div>
        @enderror
</div>  --}}
<div class="form-group">
    <label for="image" class="p-5 border-8 border-dashed  border-blue-600  ">Image</label>
    <input type="file" name="image" id="image" class="form-control" accept="image/*"/>
    @error('image')
        <div  class="text-red-600">{{ $message }}</div>
        @enderror
    @if($category->image)
    <img src="{{ asset('uploads/'.$category->image) }}" class="border-t-8 border-blue-600  " style="height: 300px" alt="" >

    @endif
</div>
<div class="form-group">
    <label for="">Status</label>
   <x-form.radio name="status" :checked="$category->status" :options="['active'=>'Active','inactive'=>'Inactive']" />
    @error('status')
        <div  class="text-red-600">{{ $message }}</div>
        @enderror

</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $botton_label ?? "Save" }}</button>
</div>
