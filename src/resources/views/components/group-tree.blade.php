@props([
    'groups' => null
])

<ul class="list-group list-group-flush ml-3">
    @foreach($groups as $group)
        <li class="list-group-item border-0 pl-2">
            <div class="d-flex justify-content-between align-items-center">
                @if($group->children->isNotEmpty())
                    <a data-toggle="collapse" href="#group-{{ $group->id }}" role="button" aria-expanded="false"
                       aria-controls="group-{{ $group->id }}" class="font-weight-bold text-dark">
                        {{ $group->name }}
                    </a>
                @else
                    <a href="{{ route('catalog.group', $group->id) }}" class="text-dark">
                        {{ $group->name }}
                    </a>
                @endif

                <span class="badge badge-secondary badge-pill">{{ $group->total_products }}</span>
            </div>

            @if($group->children->isNotEmpty())
                <div class="collapse ml-3 mt-1" id="group-{{ $group->id }}">
                    <x-group-tree :groups="$group->children"/>
                </div>
            @endif
        </li>
    @endforeach
</ul>
