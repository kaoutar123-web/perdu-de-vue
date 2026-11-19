@props(['item'])

<x-card class="flex flex-col gap-3 transition hover:shadow-md">
    <div class="flex items-center justify-between gap-2">
        <x-badge :classes="$item->place->kind->badgeClasses()">
            {{ $item->place->kind->label() }} · {{ $item->place->name }}
        </x-badge>
        <span class="text-xs text-slate-500">N° {{ $item->id }}</span>
    </div>

    <div>
        <h3 class="text-lg font-semibold">
            <a href="{{ route('items.show', $item) }}"
               class="hover:underline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700">
                {{ $item->name }}
            </a>
        </h3>
        <p class="text-sm text-slate-500">Trouvé le {{ $item->found_on->format('d/m/Y') }}</p>
    </div>

    <div class="flex flex-wrap gap-1">
        <x-badge :classes="$item->color->badgeClasses()">{{ $item->color->label() }}</x-badge>
        @foreach ($item->tags as $tag)
            <x-badge>{{ $tag->name }}</x-badge>
        @endforeach
    </div>

    @if ($item->isReturned())
        <x-badge classes="bg-green-100 text-green-800" class="self-start">Restitué</x-badge>
    @else
        <x-badge classes="bg-yellow-100 text-yellow-800" class="self-start">En attente</x-badge>
    @endif
</x-card>
