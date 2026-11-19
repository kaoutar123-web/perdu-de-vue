@php
    $item ??= null;

    $checkedTags = session()->hasOldInput()
        ? array_map('intval', old('tags', []))
        : ($item ? $item->tags->pluck('id')->all() : []);
@endphp

<div class="space-y-5">
    <div>
        <x-label for="name">Nom de l'objet</x-label>
        <x-input name="name" :value="$item?->name" />
    </div>

    <div class="grid gap-5 sm:grid-cols-3">
        <div>
            <x-label for="color">Couleur</x-label>
            <x-select name="color">
                <option value="">Choisir…</option>
                @foreach ($colors as $color)
                    <option value="{{ $color->value }}" @selected(old('color', $item?->color?->value) === $color->value)>
                        {{ $color->label() }}
                    </option>
                @endforeach
            </x-select>
        </div>

        <div>
            <x-label for="found_on">Trouvé le</x-label>
            <x-input name="found_on" type="date" :value="$item?->found_on?->format('Y-m-d')" />
        </div>

        <div>
            <x-label for="place_id">Lieu</x-label>
            <x-select name="place_id">
                <option value="">Choisir…</option>
                @foreach ($places as $place)
                    <option value="{{ $place->id }}" @selected((int) old('place_id', $item?->place_id) === $place->id)>
                        {{ $place->name }}
                    </option>
                @endforeach
            </x-select>
        </div>
    </div>

    <div>
        <x-label for="description">Description (facultative)</x-label>
        <x-textarea name="description" :value="$item?->description" />
    </div>

    <fieldset>
        <legend class="mb-2 text-sm font-medium text-slate-800">Étiquettes</legend>
        <div class="grid grid-cols-2 gap-2 sm:grid-cols-4">
            @foreach ($tags as $tag)
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                           class="rounded border-slate-300 text-blue-800 focus-visible:outline-2 focus-visible:outline-blue-700"
                           @checked(in_array($tag->id, $checkedTags, true))>
                    {{ $tag->name }}
                </label>
            @endforeach
        </div>
        @error('tags')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        @error('tags.*')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </fieldset>
</div>