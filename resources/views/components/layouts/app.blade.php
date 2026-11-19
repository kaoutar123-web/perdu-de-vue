<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Perdu de vue' }} · Perdu de vue</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <header class="bg-blue-800 text-white">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-3 px-4 py-4">
            <a href="{{ route('items.index') }}"
               class="text-xl font-bold focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                Perdu de vue
            </a>

            <nav class="flex items-center gap-2 text-sm font-medium">
                <a href="{{ route('items.index') }}"
                   @class([
                       'rounded-md px-3 py-2 hover:bg-blue-700 focus-visible:outline-2 focus-visible:outline-white',
                       'bg-blue-900' => request()->routeIs('items.index'),
                   ])>
                    Objets
                </a>
                <a href="{{ route('items.create') }}"
                   @class([
                       'rounded-md px-3 py-2 hover:bg-blue-700 focus-visible:outline-2 focus-visible:outline-white',
                       'bg-blue-900' => request()->routeIs('items.create'),
                   ])>
                    Ajouter
                </a>
                <a href="{{ route('styleguide') }}"
                   @class([
                       'rounded-md px-3 py-2 hover:bg-blue-700 focus-visible:outline-2 focus-visible:outline-white',
                       'bg-blue-900' => request()->routeIs('styleguide'),
                   ])>
                    Composants
                </a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8">
        @if (session('status'))
            <div role="status" class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-900">
                {{ session('status') }}
            </div>
        @endif

        {{ $slot }}
    </main>
</body>
</html>