<x-layouts.app title="Composants">
    <h1 class="mb-6 text-2xl font-bold">Composants</h1>

    <h2 class="mb-2 font-semibold">Boutons</h2>
    <div class="mb-6 flex gap-2">
        <x-button>Principal</x-button>
        <x-button variant="secondary">Secondaire</x-button>
        <x-button variant="danger">Danger</x-button>
    </div>

    <h2 class="mb-2 font-semibold">Badges</h2>
    <div class="mb-6 flex gap-2">
        <x-badge>Étiquette</x-badge>
        <x-badge classes="bg-green-100 text-green-800">Restitué</x-badge>
        <x-badge classes="bg-yellow-100 text-yellow-800">En attente</x-badge>
    </div>

    <h2 class="mb-2 font-semibold">Carte</h2>
    <x-card>Contenu d'une carte.</x-card>
</x-layouts.app>