@props(['name', 'type' => 'text', 'value' => null])

<input
    type="{{ $type }}"
    id="{{ $name }}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    {{ $attributes->class([
        'w-full rounded-lg border bg-white px-3 py-2 focus-visible:outline-2 focus-visible:outline-blue-700',
        'border-red-500' => $errors->has($name),
        'border-slate-300' => ! $errors->has($name),
    ]) }}
>
@error($name)
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
@enderror
