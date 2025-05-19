<x-layout>
    <h1 class="text-center mb-4">Каталог</h1>

    <div class="row">
        <div class="col-md-4">
            <h4 class="text-right mb-4">Категории</h4>
            <x-group-tree :groups="$groups"/>
        </div>
        <div class="col-md-8">
            <x-sort-view/>
            <div class="row">
                @foreach($products as $product)
                    <x-card :product="$product"/>
                @endforeach
            </div>
            {{ $products->withQueryString()->links() }}
        </div>
    </div>
</x-layout>
