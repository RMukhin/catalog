@props([
    'product'
])

<div class="col-md-4 mb-4">
    <div class="card h-100">
        <div class="card-body text-center">
            <a href="{{ route('catalog.product', $product->id) }}">{{ $product->name }}</a>
            - {{ $product->price }} руб.
        </div>
    </div>
</div>
