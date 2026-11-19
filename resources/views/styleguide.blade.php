<x-layouts.app title="Composants">
    <h1 class="mb-6 text-2xl font-bold">Composants</h1>

    <section class="mb-8">
        <h2 class="mb-2 font-semibold">Boutons (<code>x-button</code>)</h2>
        <div class="flex flex-wrap gap-2">
            <x-button>Principal</x-button>
            <x-button variant="secondary">Secondaire</x-button>
            <x-button variant="danger">Danger</x-button>
            <x-button variant="secondary" href="#">Lien-bouton</x-button>
        </div>
    </section>

    <section class="mb-8">
        <h2 class="mb-2 font-semibold">Badges (<code>x-badge</code>)</h2>
        <div class="flex flex-wrap gap-2">
            <x-badge>Étiquette</x-badge>
            <x-badge classes="bg-green-100 text-green-800">Restitué</x-badge>
            <x-badge classes="bg-yellow-100 text-yellow-800">En attente</x-badge>
        </div>
        <p class="mb-1 mt-4 text-sm text-slate-500">Lieux (enum PlaceKind)</p>
        <div class="flex flex-wrap gap-2">
            @foreach (App\Enums\PlaceKind::cases() as $kind)
                <x-badge :classes="$kind->badgeClasses()">{{ $kind->label() }}</x-badge>
            @endforeach
        </div>
        <p class="mb-1 mt-4 text-sm text-slate-500">Couleurs (enum Color)</p>
        <div class="flex flex-wrap gap-2">
            @foreach (App\Enums\Color::cases() as $color)
                <x-badge :classes="$color->badgeClasses()">{{ $color->label() }}</x-badge>
            @endforeach
        </div>
    </section>

    <section class="mb-8">
        <h2 class="mb-2 font-semibold">Carte (<code>x-card</code>)</h2>
        <x-card>Contenu d'une carte.</x-card>
    </section>

    <section class="mb-8">
        <h2 class="mb-2 font-semibold">Champs (<code>x-label</code>, <code>x-input</code>, <code>x-select</code>, <code>x-textarea</code>)</h2>
        <x-card class="max-w-lg space-y-4">
            <div>
                <x-label for="demo_input">Champ texte</x-label>
                <x-input name="demo_input" />
            </div>
            <div>
                <x-label for="demo_select">Liste</x-label>
                <x-select name="demo_select">
                    <option>Option 1</option>
                    <option>Option 2</option>
                </x-select>
            </div>
            <div>
                <x-label for="demo_textarea">Zone de texte</x-label>
                <x-textarea name="demo_textarea" />
            </div>
        </x-card>
    </section>
</x-layouts.app>