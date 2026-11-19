<x-layouts.app :title="$place->name">
    <a href="{{ route('items.index') }}" class="text-sm text-blue-800 hover:underline">← Retour à la liste</a>

    <div class="mt-4 mb-6">
        <h1 class="text-2xl font-bold">{{ $place->name }}</h1>
        <x-badge :classes="$place->kind->badgeClasses()">{{ $place->kind->label() }}</x-badge>
    </div>

    @if ($items->isEmpty())
        <x-card>Aucun objet n'a été trouvé à cet endroit.</x-card>
    @else
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($items as $item)
                <x-item-card :item="$item" />
            @endforeach
        </div>
    @endif
</x-layouts.app>