<x-layouts.app :title="$item->name">
    <a href="{{ route('items.index') }}" class="text-sm text-blue-800 hover:underline">← Retour à la liste</a>

    <x-card class="mt-4">
        <div class="mb-4 flex flex-wrap items-start justify-between gap-3">
            <h1 class="text-2xl font-bold">{{ $item->name }}</h1>
            @if ($item->isReturned())
                <x-badge classes="bg-green-100 text-green-800">Restitué</x-badge>
            @else
                <x-badge classes="bg-yellow-100 text-yellow-800">En attente</x-badge>
            @endif
        </div>

        <dl class="grid gap-4 sm:grid-cols-2">
            <div>
                <dt class="text-sm text-slate-500">Lieu</dt>
                <dd>
                    <a href="{{ route('places.show', $item->place) }}" class="text-blue-800 hover:underline">
                        {{ $item->place->kind->label() }} · {{ $item->place->name }}
                    </a>
                </dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Trouvé le</dt>
                <dd>{{ $item->found_on->format('d/m/Y') }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Couleur</dt>
                <dd><x-badge :classes="$item->color->badgeClasses()">{{ $item->color->label() }}</x-badge></dd>
            </div>
            @if ($item->isReturned())
                <div>
                    <dt class="text-sm text-slate-500">Restitué le</dt>
                    <dd>{{ $item->returned_at->format('d/m/Y') }}</dd>
                </div>
            @endif
            <div class="sm:col-span-2">
                <dt class="text-sm text-slate-500">Description</dt>
                <dd>{{ $item->description ?? 'Aucune description.' }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm text-slate-500">Étiquettes</dt>
                <dd class="flex flex-wrap gap-1">
                    @forelse ($item->tags as $tag)
                        <x-badge>{{ $tag->name }}</x-badge>
                    @empty
                        <span class="text-slate-500">Aucune étiquette.</span>
                    @endforelse
                </dd>
            </div>
        </dl>
    </x-card>
</x-layouts.app>