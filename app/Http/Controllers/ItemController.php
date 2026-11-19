<?php

namespace App\Http\Controllers;

use App\Enums\Color;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\Place;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function index(Request $request): View
    {
        $placeId = $request->integer('lieu');
        $color = Color::tryFrom((string) $request->query('couleur'));

        $items = Item::with(['place', 'tags'])
            ->whereNull('returned_at')
            ->when($placeId, fn ($query) => $query->where('place_id', $placeId))
            ->when($color, fn ($query) => $query->where('color', $color->value))
            ->orderByDesc('found_on')
            ->orderByDesc('id')
            ->get();

        return view('items.index', [
            'items' => $items,
            'places' => Place::orderBy('name')->get(),
            'colors' => Color::cases(),
            'selectedPlace' => $placeId,
            'selectedColor' => $color,
        ]);
    }

    public function show(Item $item): View
    {
        $item->load(['place', 'tags']);

        return view('items.show', ['item' => $item]);
    }

    public function create(): View
    {
        return view('items.create', $this->formData());
    }

    public function store(ItemRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $tagIds = $data['tags'] ?? [];
        unset($data['tags']);

        $item = Item::create($data);
        $item->tags()->sync($tagIds);

        return redirect()
            ->route('items.show', $item)
            ->with('status', "L'objet a été ajouté.");
    }

    public function edit(Item $item): View
    {
        $item->load('tags');

        return view('items.edit', $this->formData() + ['item' => $item]);
    }

    public function update(ItemRequest $request, Item $item): RedirectResponse
    {
        $data = $request->validated();
        $tagIds = $data['tags'] ?? [];
        unset($data['tags']);

        $item->update($data);
        $item->tags()->sync($tagIds);

        return redirect()
            ->route('items.show', $item)
            ->with('status', "L'objet a été modifié.");
    }

    public function return(Item $item): RedirectResponse
    {
        if ($item->isReturned()) {
            return redirect()
                ->route('items.show', $item)
                ->with('status', 'Cet objet a déjà été restitué le '.$item->returned_at->format('d/m/Y').'.');
        }

        $item->update(['returned_at' => today()]);

        return redirect()
            ->route('items.index')
            ->with('status', "« {$item->name} » a retrouvé son propriétaire.");
    }

    public function destroy(Item $item): RedirectResponse
    {
        $item->delete();

        return redirect()
            ->route('items.index')
            ->with('status', "L'objet a été supprimé.");
    }

    private function formData(): array
    {
        return [
            'places' => Place::orderBy('name')->get(),
            'colors' => Color::cases(),
            'tags' => Tag::orderBy('name')->get(),
        ];
    }
}
