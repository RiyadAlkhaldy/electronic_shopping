@if(session()->has('success'))
<div class="alert alert-success">{{session('success')}}</div>
<div class="alert alert-primary" >
    {{session('success')}}
</div>
@endif