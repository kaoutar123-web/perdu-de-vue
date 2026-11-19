<x-layouts.app :title="'Modifier '.$item->name">
    <h1 class="mb-6 text-2xl font-bold">Modifier « {{ $item->name }} »</h1>

    <x-card>
        <form method="POST" action="{{ route('items.update', $item) }}">
            @csrf
            @method('PUT')
            @include('items._form')

            <div class="mt-6 flex gap-2">
                <x-button>Enregistrer</x-button>
                <x-button variant="secondary" :href="route('items.show', $item)">Annuler</x-button>
            </div>
        </form>
    </x-card>
</x-layouts.app>
