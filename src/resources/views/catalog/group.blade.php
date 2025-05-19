<x-layout>
    <h1>{{ $group->name }}</h1>
    <div class="row">
        <div class="col-md-3">
            <h4>Подкатегории</h4>
            <ul class="list-group list-group-flush ml-3">
                @forelse($group->children as $subgroup)
                    <li class="list-group-item border-0 pl-2">
                        <a href="{{ route('catalog.group', $subgroup->id) }}">{{ $subgroup->name }}</a>
                    </li>
                @empty
                    <p>Нет подкатегорий</p>
                @endforelse
            </ul>
        </div>
        <div class="col-md-9">
            <x-sort-view :isMain="false"/>

            @foreach($products as $product)
                <div class="border-bottom py-2">
                    <a href="{{ route('catalog.product', $product->id) }}">{{ $product->name }}</a> -
                    <strong>{{ $product->price->price }} руб.</strong>
                </div>
            @endforeach
            <div class="mt-3">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-layout>
