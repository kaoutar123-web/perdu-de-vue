@props(['name', 'value' => null])

<textarea
    id="{{ $name }}"
    name="{{ $name }}"
    rows="4"
    {{ $attributes->class([
        'w-full rounded-lg border bg-white px-3 py-2 focus-visible:outline-2 focus-visible:outline-blue-700',
        'border-red-500' => $errors->has($name),
        'border-slate-300' => ! $errors->has($name),
    ]) }}
>{{ old($name, $value) }}</textarea>
@error($name)
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
@enderror