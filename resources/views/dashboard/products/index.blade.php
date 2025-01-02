@extends('layouts.dashboard')

@section('pagetitle','Products')
@section('create')

<div class="p-5">
    <a href="{{ route('dashboard.products.create')  }}" class="btn btn-sm btn-outline-primary mr-2">
        Create
    </a>
    {{--  <a href="{{ route('dashboard.products.trash')  }}" class="btn btn-sm btn-outline-primary">
        Trash
    </a>  --}}
</div>
@endsection

@section('content')

 <x-alert/>
 <form class="d-flex justify-content-around mx-3 mb-4" action="{{URL::current()}}" method="GET">
    <x-form.input name="name" id="name" style="width: 50%"  :value="request('name')"/>
    <div class="form-check">
        <input type="radio" name="status" value="" @checked(old('status',request('status')) == '')
            id="form-check-input" />
        <label for="form-check-input" class="form-check-label">All</label>
    </div>
    
       <x-form.radio name="status" :checked="request('status')" :options="['active'=>'Active','inactive'=>'Inactive']" />
       
    <submit  class="btn btn-dark">Filter</submit>
 </form>
<table class="table">
 <thead>
     <tr>
         <td>Id</td>
         <td>Name</td>
         <td>Category</td>
         <td>Store</td>
         <td>Status</td>
         <td>Image</td>
         <td>Created At</td>
         <td>Edit</td>
         <td>Delete</td>
     </tr>
 </thead>
 <tbody>
     @forelse ($products as $product)
         <tr>
             <td>{{$product->id}}</td>
             <td>{{$product->name}}</td>
             <td>{{$product->category->name}}</td>
             <td>{{$product->store->name}}</td>
             <td>{{$product->status}}</td>
             {{--  <td><img src="{{ asset('uploads/'.$product->image) }}" alt="" height="100"></td>  --}}
             <td><img src="{{ $product->image }}" alt="" height="100"></td>
             <td>{{$product->created_at}}</td>
             <td>
                 <a href="{{ route('dashboard.products.edit', ['product'=>$product]) }}"> Edit</a>
             </td>
             <td>
                 <form action="{{ route('dashboard.products.destroy', ['product'=>$product]) }}" method="POST">
                     @csrf
                     <input type="hidden" name="_mehtode" value="delete">
                     @method('delete')
                     <input type="submit" value="Delete" class="btn btn-sm btn-outline-danger">

                 </form>
             </td>
     </tr>
     @empty
     <tr>
        <td colspan="9">no Products defined</td>
    </tr>
     @endforelse
 </tbody>
</table>
<div  style="width: 95% "  >
    {{$products->withQueryString()->links()}}

</div>
@endsection