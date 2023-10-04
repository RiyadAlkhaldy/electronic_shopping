{{ $errors }}
<div class="form-group">
    <label for="name">Product name </label>
    <x-form.input name="name" id="name" type="text" value="{{$product->name}}" />
</div>

<div class="form-group">
    <label for="category_id"></label>
    <select name="category_id" id="category_id" class="form-control form-select">
        <option value="">Primagry Category</option>
        @foreach (App\Models\Category::all() as $category )
        <option value="{{ $category->id }}" @selected(old('category_id',$product->category_id) == $category->id)>{{ $category->name  }}</option>

        @endforeach

    </select>
</div>

<x-form.textarea name="description" id="Description" :value="$product->description" label="Description" />


<div class="form-group">
    <label for="image" class="p-5 border-8 border-dashed  border-blue-600  ">Image</label>
    <input type="file" name="image" id="image" class="form-control" accept="image/*" />
    @error('image')
    <div class="text-red-600">{{ $message }}</div>
    @enderror
    @if($product->image)
    <img src="{{ asset('uploads/'.$product->image) }}" class="border-t-8 border-blue-600  " style="height: 300px" />
    @endif
</div>

<div class="form-group">
    <label for="price">Product Price </label>
    <x-form.input name="price" id="price" type="text" value="{{$product->price}}" />
</div>

<div class="form-group">
    <label for="compare_price">Product Compare Price </label>
    <x-form.input name="compare_price" id="compare_price" type="text" value="{{$product->compare_price}}" />
</div>

<div class="form-group">
    <label for="tag_id">Tags  </label>
    <x-form.input name="tags" id="tag_id" type="text" :value="$tags" />
</div>

<div class="form-group">
    <label for="">Status</label>
    <x-form.radio name="status" :checked="$product->status" :options="['active'=>'Active','draft'=>'Draft','archvied'=>'Archvied']" />
    @error('status')
    <div class="text-red-600">{{ $message }}</div>
    @enderror

</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $botton_label ?? "Save" }}</button>
</div>
@push('style')
<link href="{{ asset('css/yaireo_tagify_dist_tagify.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
<script src="{{ asset('js/yaireo_tagify.min.js') }}"></script>
<script src="{{asset('js/yaireo_tagify_dist_tagify.polyfills.min.js')}}"></script>
<script>
    var inputElm = document.querySelector('[name=tags]'),
    tagify = new Tagify (inputElm);

{{--  inputElm.addEventListener('change', onChange)

function onChange(e){
  // outputs a String
  console.log(e.target.value)  --}}
{{--  }  --}}

</script>
@endpush
