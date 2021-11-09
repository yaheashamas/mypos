@if ($errors->any())
    <div class="error text-danger text-bold">{{ $errors->first($name) }}</div>
@endif
