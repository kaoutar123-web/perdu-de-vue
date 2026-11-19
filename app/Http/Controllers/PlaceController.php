<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\View\View;

class PlaceController extends Controller
{
    public function show(Place $place): View
    {
        $items = $place->items()
            ->with(['place', 'tags'])
            ->orderByDesc('found_on')
            ->orderByDesc('id')
            ->get();

        return view('places.show', [
            'place' => $place,
            'items' => $items,
        ]);
    }
}
