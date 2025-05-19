<x-layout>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('catalog.index') }}">Главная</a></li>
            @foreach($breadcrumbs as $crumb)
                <li class="breadcrumb-item">
                    <a href="{{ route('catalog.group', $crumb->id) }}">{{ $crumb->name }}</a>
                </li>
            @endforeach
        </ol>
    </nav>
    <div class="jumbotron">

        <h2>{{ $product->name }}</h2>
        <p><strong>Цена:</strong> {{ $product->price->price }} руб.</p>
    </div>


</x-layout>
