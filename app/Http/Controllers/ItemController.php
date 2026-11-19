<?php

namespace App\Http\Controllers;

use App\Enums\Color;
use App\Models\Item;
use App\Models\Place;
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
}
