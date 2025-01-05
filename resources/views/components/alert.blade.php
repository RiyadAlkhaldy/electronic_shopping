@if (session()->has($type))
    <div class="alert alert-{$type}">the message is : {{ session($type) }}</div>
    <div class="alert alert-{$type}">
        {{ session('message') }}
    </div>
@endif
