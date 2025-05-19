@props([
    'isMain' => true
])
<div class="mb-3">
    <strong>Сортировать:</strong>
    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}">По цене ↑</a> |
    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}">По цене ↓</a> |
    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}">По названию ↑</a> |
    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}">По названию ↓</a>
    @if($isMain)

        <form method="GET" id="perPageForm" class="d-inline-block">
            <label for="per_page">Показать по:</label>
            <select name="per_page" id="per_page" onchange="document.getElementById('perPageForm').submit()">
                @foreach([6, 12, 18] as $option)
                    <option value="{{ $option }}" {{ request('per_page', 6) == $option ? 'selected' : '' }}>
                        {{ $option }}
                    </option>
                @endforeach
            </select>

            @if(request()->has('sort'))
                <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif
        </form>
    @endif

</div>
